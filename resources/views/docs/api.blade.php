@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    API Documentation
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Complete reference for all available API endpoints. Choose a version and explore the documentation below.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Sidebar Navigation -->
            <aside class="lg:col-span-3">
                <div class="sticky top-8">
                    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                            <h2 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wide">
                                API Endpoints
                            </h2>
                        </div>
                        
                        <nav class="px-2 py-4 max-h-[calc(100vh-12rem)] overflow-y-auto">
                            @foreach (__('docs.api') as $version => $versionData)
                                <div class="mb-6">
                                    <h3 class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
                                        {{ $version }}
                                    </h3>
                                    
                                    @foreach ($versionData as $groupName => $groupEndpoints)
                                        <div class="mb-4">
                                            <div class="px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">
                                                {{ $groupName }}
                                            </div>
                                            <ul class="space-y-1">
                                                @foreach ($groupEndpoints as $endpoint)
                                                    @php $endpointId = urlencode($endpoint['route']).$endpoint['method']; @endphp
                                                    <li>
                                                        <a href="#{{ $endpointId }}" 
                                                           class="group flex items-center px-3 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                            <span class="inline-flex items-center justify-center w-14 px-2 py-0.5 text-xs font-medium rounded mr-2
                                                                @if(strtoupper($endpoint['method']) === 'GET') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                                @elseif(strtoupper($endpoint['method']) === 'POST') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                                @elseif(strtoupper($endpoint['method']) === 'DELETE') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                                @elseif(strtoupper($endpoint['method']) === 'PUT') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                                @elseif(strtoupper($endpoint['method']) === 'PATCH') bg-cyan-100 text-cyan-800 dark:bg-cyan-900 dark:text-cyan-200
                                                                @endif">
                                                                {{ strtoupper($endpoint['method']) }}
                                                            </span>
                                                            <span class="text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white truncate">
                                                                {{ $endpoint['route'] }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="lg:col-span-9">
                @foreach (__('docs.api') as $version => $versionData)
                    <div class="mb-12">
                        <!-- Version Header -->
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ $version }}
                            </h2>
                            <div class="h-1 w-20 bg-dscpics-500 rounded-full"></div>
                        </div>

                        @foreach ($versionData as $groupName => $groupEndpoints)
                            <div class="mb-10">
                                <!-- Group Header -->
                                <div class="mb-6">
                                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                                        {{ $groupName }}
                                    </h3>
                                    <div class="h-0.5 w-16 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                                </div>

                                <!-- Endpoints -->
                                <div class="space-y-6">
                                    @foreach ($groupEndpoints as $endpoint)
                                        @php $endpointId = urlencode($endpoint['route']).$endpoint['method']; @endphp
                                        
                                        <article id="{{ $endpointId }}" 
                                                 class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden scroll-mt-24 transition-all duration-300">
                                            
                                            <!-- Endpoint Header -->
                                            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center flex-wrap gap-3">
                                                    <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-md
                                                        @if(strtoupper($endpoint['method']) === 'GET') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                        @elseif(strtoupper($endpoint['method']) === 'POST') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                        @elseif(strtoupper($endpoint['method']) === 'DELETE') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                        @elseif(strtoupper($endpoint['method']) === 'PUT') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                        @elseif(strtoupper($endpoint['method']) === 'PATCH') bg-cyan-100 text-cyan-800 dark:bg-cyan-900 dark:text-cyan-200
                                                        @endif">
                                                        {{ strtoupper($endpoint['method']) }}
                                                    </span>
                                                    <code class="text-sm font-mono text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-md">
                                                        {{ $endpoint['route'] }}
                                                    </code>
                                                </div>
                                            </div>

                                            <!-- Endpoint Body -->
                                            <div class="px-6 py-5 space-y-5">
                                                
                                                <!-- Description -->
                                                <div>
                                                    <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">
                                                        Description
                                                    </h4>
                                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                                        {{ $endpoint['description'] }}
                                                    </p>
                                                </div>

                                                <!-- Authentication -->
                                                @if (isset($endpoint['authentication']))
                                                    <div>
                                                        <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">
                                                            Authentication
                                                        </h4>
                                                        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-md">
                                                            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                            </svg>
                                                            <span class="text-sm font-medium text-amber-800 dark:text-amber-300">
                                                                {{ $endpoint['authentication'] }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Request -->
                                                @if (isset($endpoint['request']))
                                                    <div>
                                                        <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">
                                                            Request
                                                        </h4>
                                                        <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-gray-600">
                                                            <div class="bg-gray-800 px-4 py-2 flex items-center justify-between">
                                                                <span class="text-xs font-medium text-gray-400">JSON</span>
                                                                <button onclick="copyToClipboard(this)" 
                                                                        data-code="{{ htmlspecialchars($endpoint['request']) }}"
                                                                        class="text-xs text-gray-400 hover:text-white transition-colors">
                                                                    Copy
                                                                </button>
                                                            </div>
                                                            <pre class="bg-gray-900 text-gray-100 p-4 overflow-x-auto text-sm"><code>{{ $endpoint['request'] }}</code></pre>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Response -->
                                                @if (isset($endpoint['response']))
                                                    <div>
                                                        <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">
                                                            Response
                                                        </h4>
                                                        <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-gray-600">
                                                            <div class="bg-gray-800 px-4 py-2 flex items-center justify-between">
                                                                <span class="text-xs font-medium text-gray-400">JSON</span>
                                                                <button onclick="copyToClipboard(this)" 
                                                                        data-code="{{ htmlspecialchars($endpoint['response']) }}"
                                                                        class="text-xs text-gray-400 hover:text-white transition-colors">
                                                                    Copy
                                                                </button>
                                                            </div>
                                                            <pre class="bg-gray-900 text-gray-100 p-4 overflow-x-auto text-sm"><code>{{ $endpoint['response'] }}</code></pre>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </main>

        </div>
    </div>
</div>

<!-- Copy to Clipboard Script -->
<script>
function copyToClipboard(button) {
    const code = button.getAttribute('data-code');
    
    // Check if clipboard API is available
    if (!navigator.clipboard) {
        // Fallback method for older browsers or non-secure contexts
        fallbackCopyToClipboard(code, button);
        return;
    }
    
    navigator.clipboard.writeText(code).then(() => {
        // Show success toast
        window.showToast('success', 'Code copied to clipboard!', 2000);
    }).catch(err => {
        // Show error toast
        window.showToast('error', 'Failed to copy code. Please try again.', 3000);
        console.error('Failed to copy:', err);
    });
}

function fallbackCopyToClipboard(text, button) {
    // Create a temporary textarea
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.top = '-9999px';
    textArea.style.left = '-9999px';
    document.body.appendChild(textArea);
    
    try {
        textArea.focus();
        textArea.select();
        const successful = document.execCommand('copy');
        
        if (successful) {
            window.showToast('success', 'Code copied to clipboard!', 2000);
        } else {
            window.showToast('error', 'Failed to copy code. Please try again.', 3000);
        }
    } catch (err) {
        window.showToast('error', 'Copy not supported in this browser.', 3000);
        console.error('Fallback copy failed:', err);
    } finally {
        document.body.removeChild(textArea);
    }
}

// Smooth scroll for anchor links with proper offset
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const target = document.getElementById(targetId);
            
            if (target) {
                // Calculate offset for sticky header (if any) + some padding
                const offset = 100;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Update URL without jumping
                history.pushState(null, null, '#' + targetId);
                
                // Highlight the target briefly
                target.classList.add('ring-2', 'ring-dscpics-500', 'ring-opacity-50');
                setTimeout(() => {
                    target.classList.remove('ring-2', 'ring-dscpics-500', 'ring-opacity-50');
                }, 2000);
            }
        });
    });
    
    // Handle direct URL hash on page load
    if (window.location.hash) {
        setTimeout(() => {
            const targetId = window.location.hash.substring(1);
            const target = document.getElementById(targetId);
            if (target) {
                const offset = 100;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        }, 100);
    }
});
</script>
@endsection