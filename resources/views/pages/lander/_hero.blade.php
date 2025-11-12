<section
    id="hero"
    x-data="{ show: false }"
    x-init="
        window.addEventListener('preloader:done', () => (show = true));
    "
    class="relative flex flex-col items-center justify-center overflow-hidden min-h-screen bg-gray-400 dark:bg-gray-950"
>
    {{-- Animated SVG Background --}}
    <div class="absolute inset-0 w-full h-full">
        <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="grid-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" class="text-dscpics-200 dark:text-dscpics-900" style="stop-color: currentColor; stop-opacity: 0.3" />
                    <stop offset="100%" class="text-dscpics-300 dark:text-dscpics-800" style="stop-color: currentColor; stop-opacity: 0.1" />
                </linearGradient>
                
                <filter id="glow">
                    <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                    <feMerge>
                        <feMergeNode in="coloredBlur"/>
                        <feMergeNode in="SourceGraphic"/>
                    </feMerge>
                </filter>
            </defs>
            
            {{-- Grid Pattern --}}
            <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                <path d="M 40 0 L 0 0 0 40" fill="none" class="stroke-dscpics-300 dark:stroke-dscpics-800" stroke-width="0.5" opacity="0.3"/>
            </pattern>
            <rect width="100%" height="100%" fill="url(#grid)" />
            
            {{-- Animated Glowing Orbs --}}
            <circle cx="20%" cy="30%" r="120" fill="url(#grid-gradient)" opacity="0.4" filter="url(#glow)">
                <animate attributeName="cy" values="30%;35%;30%" dur="8s" repeatCount="indefinite" />
                <animate attributeName="opacity" values="0.4;0.6;0.4" dur="8s" repeatCount="indefinite" />
            </circle>
            
            <circle cx="80%" cy="60%" r="150" fill="url(#grid-gradient)" opacity="0.3" filter="url(#glow)">
                <animate attributeName="cy" values="60%;55%;60%" dur="10s" repeatCount="indefinite" />
                <animate attributeName="opacity" values="0.3;0.5;0.3" dur="10s" repeatCount="indefinite" />
            </circle>
            
            <circle cx="50%" cy="80%" r="100" fill="url(#grid-gradient)" opacity="0.35" filter="url(#glow)">
                <animate attributeName="cx" values="50%;55%;50%" dur="12s" repeatCount="indefinite" />
                <animate attributeName="opacity" values="0.35;0.55;0.35" dur="12s" repeatCount="indefinite" />
            </circle>
        </svg>
    </div>

    {{-- Glassmorphism Overlay --}}
    <div class="absolute inset-0 backdrop-blur-[1px] bg-white/10 dark:bg-gray-950/10"></div>

    {{-- Content --}}
    <div class="relative z-10 px-6 text-center max-w-5xl mx-auto">
        <h1
            x-show="show"
            x-transition.duration.800ms
            class="text-5xl sm:text-6xl md:text-7xl font-extrabold tracking-tight text-gray-900 dark:text-white drop-shadow-lg"
        >
            {!! __('pages.lander.hero.title') !!}
        </h1>

        <p
            x-show="show"
            x-transition.delay.200ms.duration.800ms
            class="mx-auto mt-6 max-w-3xl text-xl sm:text-2xl md:text-3xl text-gray-700 dark:text-gray-200"
        >
            {!! __('pages.lander.hero.subtitle') !!}
        </p>

        @guest
            <a
                x-show="show"
                x-transition.delay.400ms.duration.800ms
                href="{{ route('login') }}"
                class="group relative mt-12 inline-flex items-center justify-center gap-3 rounded-xl px-8 py-4 text-base sm:text-lg font-semibold text-white bg-dscpics-600 hover:bg-dscpics-700 dark:bg-dscpics-500 dark:hover:bg-dscpics-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105"
            >
                {{-- Discord SVG Icon --}}
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"/>
                </svg>
                {{ __('pages.lander.hero.login_button') }}
            </a>
        @else
            <a
                x-show="show"
                x-transition.delay.400ms.duration.800ms
                href="{{ route('dashboard') }}"
                class="group relative mt-12 inline-flex items-center justify-center gap-3 rounded-xl px-8 py-4 text-base sm:text-lg font-semibold text-white bg-dscpics-600 hover:bg-dscpics-700 dark:bg-dscpics-500 dark:hover:bg-dscpics-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105"
            >
                {{-- Dashboard SVG Icon --}}
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                </svg>
                {{ __('pages.lander.hero.dashboard_button') }}
            </a>
        @endguest
    </div>

    {{-- Feature Cards --}}
    <div
        x-show="show"
        x-transition.delay.600ms.duration.800ms
        class="relative z-10 mt-16 grid grid-cols-1 gap-6 px-6 sm:grid-cols-2 max-w-4xl mx-auto"
    >
        <div class="flex items-start gap-4 p-6 rounded-xl bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border border-dscpics-200 dark:border-dscpics-800 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
            <svg class="w-8 h-8 flex-shrink-0 text-yellow-500 dark:text-yellow-400" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z"/>
            </svg>
            <div>
                <p class="font-bold text-gray-900 dark:text-white">{{ __('pages.lander.hero.fast_title') }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    {{ __('pages.lander.hero.fast_desc') }}
                </p>
            </div>
        </div>
        
        <div class="flex items-start gap-4 p-6 rounded-xl bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border border-dscpics-200 dark:border-dscpics-800 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
            <svg class="w-8 h-8 flex-shrink-0 text-dscpics-500 dark:text-dscpics-400" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"/>
            </svg>
            <div>
                <p class="font-bold text-gray-900 dark:text-white">
                    {{ __('pages.lander.hero.discord_title') }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    {{ __('pages.lander.hero.discord_desc') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Scroll Down Indicator --}}
    <div 
        x-show="show"
        x-transition.delay.800ms.duration.800ms
        class="absolute bottom-10 left-1/2 -translate-x-1/2"
    >
        <a href="#stats" class="flex flex-col items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-dscpics-600 dark:hover:text-dscpics-400 transition-colors duration-300 animate-bounce">
            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                <polyline points="7 13 12 18 17 13"/>
                <polyline points="7 6 12 11 17 6"/>
            </svg>
        </a>
    </div>
</section>