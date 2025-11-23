@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-2">{{ __('api-playground.title') }}</h1>
    <p class="text-gray-600 dark:text-gray-400 mb-8">{{ __('api-playground.description') }}</p>

    <div x-data="apiPlayground()" x-init="init()">
        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Left Column: Configuration -->
            <div class="space-y-8">
                <!-- Authentication -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">{{ __('api-playground.authentication') }}</h2>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <div class="flex items-center space-x-4 mb-4">
                            <input type="radio" id="auth_select" value="select" x-model="authMethod">
                            <label for="auth_select">{{ __('api-playground.select_your_token') }}</label>
                            
                            <input type="radio" id="auth_paste" value="paste" x-model="authMethod">
                            <label for="auth_paste">{{ __('api-playground.paste_token') }}</label>
                        </div>

                        <div x-show="authMethod === 'select'">
                            <select x-model="selectedToken" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <template x-for="token in userTokens" :key="token.id">
                                    <option :value="token.token" x-text="token.name"></option>
                                </template>
                            </select>
                        </div>
                        <div x-show="authMethod === 'paste'">
                            <input type="text" x-model="pastedToken" placeholder="{{ __('api-playground.token_input_placeholder') }}" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                    </div>
                </div>

                <!-- Request -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">{{ __('api-playground.request') }}</h2>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-4">
                        <!-- API Version -->
                        <div>
                            <label for="api_version" class="font-medium">{{ __('api-playground.api_version') }}</label>
                            <select id="api_version" x-model="apiVersion" @change="endpoint = ''" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600 mt-1">
                                <option value="">{{ __('api-playground.select_version') }}</option>
                                <option value="v1">v1</option>
                                <option value="v2">v2</option>
                            </select>
                        </div>

                        <!-- Endpoint -->
                        <div>
                            <label for="endpoint" class="font-medium">{{ __('api-playground.endpoint') }}</label>
                            <select id="endpoint" x-model="endpoint" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600 mt-1" :disabled="!apiVersion">
                                <option value="">{{ __('api-playground.select_endpoint') }}</option>
                                <template x-for="route in filteredRoutes" :key="route.uri">
                                    <option :value="route.uri" x-text="route.method + ' /' + route.uri"></option>
                                </template>
                            </select>
                        </div>

                        <!-- Request Details -->
                        <div x-show="selectedRoute" class="border-t border-gray-200 dark:border-gray-700 pt-4 space-y-4">
                            <!-- Method and URI -->
                            <div>
                                <p><strong>{{ __('api-playground.method') }}:</strong> <span x-text="selectedRoute.method" class="px-2 py-1 text-xs font-bold rounded" :class="{ 'bg-green-200 text-green-800': selectedRoute.method === 'GET', 'bg-blue-200 text-blue-800': selectedRoute.method === 'POST', 'bg-yellow-200 text-yellow-800': selectedRoute.method.match(/PUT|PATCH/), 'bg-red-200 text-red-800': selectedRoute.method === 'DELETE' }"></span></p>
                                <p class="mt-2"><strong>{{ __('api-playground.uri') }}:</strong> <code class="bg-gray-100 dark:bg-gray-700 p-1 rounded text-sm" x-text="'/api/' + apiVersion + '/' + selectedRoute.uri"></code></p>
                            </div>
                            
                            <!-- Route Parameters -->
                            <div x-show="routeParams.length > 0">
                                <h3 class="font-medium mb-2">{{ __('api-playground.parameters') }}</h3>
                                <div class="space-y-2">
                                    <template x-for="param in routeParams" :key="param">
                                        <div>
                                            <label :for="'param_' + param" x-text="param" class="block text-sm font-medium text-gray-700 dark:text-gray-300"></label>
                                            <input type="text" :id="'param_' + param" x-model="paramValues[param]" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600 mt-1">
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Request Body -->
                            <div x-show="['POST', 'PUT', 'PATCH'].includes(selectedRoute.method)">
                                <h3 class="font-medium mb-2">{{ __('api-playground.body') }} (JSON)</h3>
                                <textarea x-model="requestBody" rows="6" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600 font-mono text-sm"></textarea>
                            </div>
                        </div>

                        <button @click="sendRequest()" :disabled="!endpoint || loading" class="w-full bg-dscpics-600 text-white font-bold py-2 px-4 rounded hover:bg-dscpics-700 disabled:bg-gray-400">
                            <span x-show="!loading">{{ __('api-playground.send') }}</span>
                            <span x-show="loading">{{ __('api-playground.loading') }}</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Response -->
            <div>
                <h2 class="text-xl font-semibold mb-4">{{ __('api-playground.response') }}</h2>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow min-h-[400px] font-mono text-sm">
                    <div x-show="response">
                        <p class="font-sans"><strong>{{ __('api-playground.status') }}:</strong> 
                            <span x-text="response.status" class="px-2 py-1 text-xs font-bold rounded" :class="{ 'bg-green-200 text-green-800': response.status >= 200 && response.status < 300, 'bg-yellow-200 text-yellow-800': response.status >= 400 && response.status < 500, 'bg-red-200 text-red-800': response.status >= 500 }"></span>
                        </p>
                        
                        <h3 class="text-lg font-semibold mt-4 mb-2 font-sans">{{ __('api-playground.response_body') }}</h3>
                        <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded" x-html="highlightJson(response.body)"></pre>

                        <h3 class="text-lg font-semibold mt-4 mb-2 font-sans">{{ __('api-playground.response_headers') }}</h3>
                        <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded"><code>x-text="JSON.stringify(response.headers, null, 2)"</code></pre>
                    </div>
                    <div x-show="!response && !loading" class="text-gray-500 font-sans">
                        Your API response will appear here.
                    </div>
                    <div x-show="loading" class="text-gray-500 font-sans">
                        {{ __('api-playground.loading') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function apiPlayground() {
        return {
            loading: false,
            authMethod: 'select',
            userTokens: [],
            selectedToken: '',
            pastedToken: '',
            apiVersion: '',
            endpoint: '',
            routes: { v1: [], v2: [] },
            paramValues: {},
            requestBody: '{}',
            response: null,

            init() {
                this.loading = true;
                fetch('{{ route("api.playground.data") }}')
                    .then(res => res.json())
                    .then(data => {
                        this.routes = data.routes;
                        this.userTokens = data.tokens;
                        if (this.userTokens.length > 0) {
                            this.authMethod = 'select';
                            this.selectedToken = this.userTokens[0].token;
                        } else {
                            this.authMethod = 'paste';
                        }
                    }).finally(() => this.loading = false);
            },

            get filteredRoutes() {
                if (!this.apiVersion) return [];
                return this.routes[this.apiVersion];
            },

            get selectedRoute() {
                if (!this.endpoint) return null;
                return this.filteredRoutes.find(r => r.uri === this.endpoint);
            },

            get routeParams() {
                if (!this.selectedRoute) return [];
                return this.selectedRoute.uri.match(/{(\w+)}/g)?.map(p => p.slice(1, -1)) || [];
            },

            get finalToken() {
                return this.authMethod === 'select' ? this.selectedToken : this.pastedToken;
            },

            sendRequest() {
                if (!this.selectedRoute || !this.finalToken) {
                    alert('Please select an endpoint and provide an API token.');
                    return;
                }

                this.loading = true;
                this.response = null;

                let url = `/api/${this.apiVersion}/${this.endpoint}`;
                this.routeParams.forEach(param => {
                    url = url.replace(`{${param}}`, this.paramValues[param] || '');
                });

                const requestOptions = {
                    method: this.selectedRoute.method,
                    headers: {
                        'Authorization': 'Bearer ' + this.finalToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                };

                if (['POST', 'PUT', 'PATCH'].includes(this.selectedRoute.method)) {
                    try {
                        JSON.parse(this.requestBody);
                        requestOptions.body = this.requestBody;
                    } catch (e) {
                        alert('Invalid JSON in request body.');
                        this.loading = false;
                        return;
                    }
                }

                fetch(url, requestOptions)
                    .then(async res => {
                        const headers = {};
                        res.headers.forEach((value, key) => headers[key] = value);
                        
                        let body;
                        const contentType = res.headers.get("content-type");
                        if (contentType && contentType.indexOf("application/json") !== -1) {
                            body = await res.json();
                        } else {
                            body = await res.text();
                        }

                        this.response = { 
                            status: res.status,
                            headers: headers,
                            body: body
                        };
                    })
                    .catch(err => {
                        this.response = {
                            status: 'Network Error',
                            body: err.message
                        };
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },

            highlightJson(json) {
                if (typeof json !== 'string') {
                    json = JSON.stringify(json, undefined, 2);
                }
                json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                return json.replace(/("(\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                    let cls = 'text-red-500'; // number
                    if (/^".*"$/.test(match)) {
                        if (/:$/.test(match)) {
                            cls = 'text-blue-500'; // key
                        } else {
                            cls = 'text-green-500'; // string
                        }
                    } else if (/true|false/.test(match)) {
                        cls = 'text-purple-500'; // boolean
                    } else if (/null/.test(match)) {
                        cls = 'text-gray-500'; // null
                    }
                    return '<span class="' + cls + '">' + match + '</span>';
                });
            }
        }
    }
</script>
@endsection