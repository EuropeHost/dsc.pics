@extends('layouts.main')

@section('content')
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-100 dark:bg-gray-800 p-6 shadow-lg h-screen sticky top-0 overflow-y-auto">
            <h3 class="text-xl font-bold text-dscpics-700 dark:text-dscpics-300 mb-5 pb-3 border-b border-gray-300 dark:border-gray-600">
                API Endpoints
            </h3>
            <nav>
                @foreach (__('docs.api') as $version => $versionData)
                    <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mt-5 mb-2">{{ $version }}</h4>
                    @foreach ($versionData as $groupName => $groupEndpoints)
                        <p class="font-medium text-gray-600 dark:text-gray-400 mt-3 mb-1">{{ $groupName }}</p>
                        <ul class="ml-3 border-l border-gray-300 dark:border-gray-700">
                            @foreach ($groupEndpoints as $endpoint)
                                @php
                                    $endpointId = urlencode($endpoint['route']);
                                @endphp
                                <li class="mb-1">
                                    <a href="#{{ $endpointId }}"
                                        class="block py-1 px-2 text-gray-700 dark:text-gray-300 hover:bg-dscpics-100 dark:hover:bg-dscpics-900 rounded transition-colors duration-200">
                                        <span class="text-xs font-bold uppercase mr-2
                                            @if (strtolower($endpoint['method']) === 'get') text-api-get
                                            @elseif (strtolower($endpoint['method']) === 'post') text-api-post
                                            @elseif (strtolower($endpoint['method']) === 'delete') text-api-delete
                                            @elseif (strtolower($endpoint['method']) === 'put') text-api-put
                                            @elseif (strtolower($endpoint['method']) === 'patch') text-api-patch @endif">
                                            {{ $endpoint['method'] }}
                                        </span>
                                        <code class="text-xs">{{ $endpoint['route'] }}</code>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @endforeach
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 container mx-auto p-4 sm:p-6 lg:p-8">
            <h1 class="text-3xl font-bold text-dscpics-700 dark:text-dscpics-300 mb-6 pb-2 border-b-2 border-gray-200">
                API Documentation
            </h1>

            @foreach (__('docs.api') as $version => $versionData)
                <h2 class="text-2xl font-semibold text-dscpics-600 dark:text-dscpics-400 mt-8 mb-4 pb-2 border-b border-gray-200">
                    {{ $version }}
                </h2>
                @foreach ($versionData as $groupName => $groupEndpoints)
                    <div class="endpoint-group mb-8 pl-4 border-l-4 border-gray-300">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6 mb-4">
                            {{ $groupName }}
                        </h3>
                        @foreach ($groupEndpoints as $endpoint)
                            @php
                                $endpointId = urlencode($endpoint['route']);
                            @endphp
                            <div id="{{ $endpointId }}" class="endpoint bg-white dark:bg-gray-800 p-5 mb-5 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                                <div class="flex items-center mb-3">
                                    <span
                                        class="endpoint-method mr-3 px-3 py-1 rounded text-white text-sm font-bold uppercase
                                        @if (strtolower($endpoint['method']) === 'get') bg-api-get
                                        @elseif (strtolower($endpoint['method']) === 'post') bg-api-post
                                        @elseif (strtolower($endpoint['method']) === 'delete') bg-api-delete
                                        @elseif (strtolower($endpoint['method']) === 'put') bg-api-put text-gray-900
                                        @elseif (strtolower($endpoint['method']) === 'patch') bg-api-patch @endif"
                                    >
                                        {{ $endpoint['method'] }}
                                    </span>
                                    <code class="bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded text-gray-700 dark:text-gray-300 text-sm">
                                        {{ $endpoint['route'] }}
                                    </code>
                                </div>
                                <p class="mb-3 text-gray-700 dark:text-gray-300">
                                    <strong class="text-dscpics-500">Description:</strong>
                                    {{ $endpoint['description'] }}
                                </p>

                                @if (isset($endpoint['authentication']))
                                    <p class="mb-3 text-gray-700 dark:text-gray-300">
                                        <strong class="text-dscpics-500">Authentication:</strong>
                                        {{ $endpoint['authentication'] }}
                                    </p>
                                @endif

                                @if (isset($endpoint['request']))
                                    <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-2 mt-4">
                                        Request:
                                    </h4>
                                    <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded-md overflow-x-auto text-sm text-gray-800 dark:text-gray-200 border-l-4 border-blue-500"><code>{{ $endpoint['request'] }}</code></pre>
                                @endif

                                @if (isset($endpoint['response']))
                                    <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-2 mt-4">
                                        Response:
                                    </h4>
                                    <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded-md overflow-x-auto text-sm text-gray-800 dark:text-gray-200 border-l-4 border-blue-500"><code>{{ $endpoint['response'] }}</code></pre>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endforeach
        </main>
    </div>
@endsection