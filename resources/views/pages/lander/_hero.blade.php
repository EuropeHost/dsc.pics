<section
    id="hero"
    x-data="{ show: false }"
    x-init="
        window.addEventListener('preloader:done', () => (show = true));
    "
    class="relative flex flex-col items-center justify-center overflow-hidden min-h-screen bg-gray-50 dark:bg-gray-950"
>
    <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="dots" x="0" y="0" width="24" height="24" patternUnits="userSpaceOnUse">
                <circle cx="2" cy="2" r="1" class="fill-gray-300 dark:fill-gray-800" />
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#dots)" />
        
        <circle cx="15%" cy="20%" r="120" class="fill-dscpics-500/10 dark:fill-dscpics-400/5">
            <animate attributeName="cy" values="20%;25%;20%" dur="8s" repeatCount="indefinite" />
        </circle>
        
        <rect x="70%" y="50%" width="200" height="200" rx="20" class="fill-purple-500/10 dark:fill-purple-400/5">
            <animateTransform attributeName="transform" type="rotate" from="0 80 60" to="360 80 60" dur="20s" repeatCount="indefinite" />
        </rect>
        
        <polygon points="45,80 50,70 55,80" class="fill-dscpics-400/10 dark:fill-dscpics-300/5" transform="translate(1200, 600) scale(30)">
            <animateTransform attributeName="transform" type="translate" values="1200,600; 1250,650; 1200,600" dur="12s" repeatCount="indefinite" />
        </polygon>
    </svg>

    <div class="relative z-10 px-6 text-center max-w-5xl mx-auto">
        <h1
            x-show="show"
            x-transition.duration.800ms
            class="text-5xl sm:text-6xl md:text-7xl font-extrabold tracking-tight text-gray-900 dark:text-white"
        >
            {!! __('pages.lander.hero.title') !!}
        </h1>

        <p
            x-show="show"
            x-transition.delay.200ms.duration.800ms
            class="mx-auto mt-6 max-w-3xl text-xl sm:text-2xl md:text-3xl text-gray-700 dark:text-gray-300"
        >
            {!! __('pages.lander.hero.subtitle') !!}
        </p>

        @guest
            <a
                x-show="show"
                x-transition.delay.400ms.duration.800ms
                href="{{ route('login') }}"
                class="mt-12 inline-flex items-center justify-center gap-3 rounded-xl px-8 py-4 text-base sm:text-lg font-semibold text-white bg-dscpics-600 hover:bg-dscpics-700 dark:bg-dscpics-500 dark:hover:bg-dscpics-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105"
            >
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
                class="mt-12 inline-flex items-center justify-center gap-3 rounded-xl px-8 py-4 text-base sm:text-lg font-semibold text-white bg-dscpics-600 hover:bg-dscpics-700 dark:bg-dscpics-500 dark:hover:bg-dscpics-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105"
            >
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                </svg>
                {{ __('pages.lander.hero.dashboard_button') }}
            </a>
        @endguest

        <div
            x-show="show"
            x-transition.delay.600ms.duration.800ms
            class="mt-16 grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-2xl mx-auto"
        >
            <div class="flex items-start gap-4 p-6 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
                <svg class="w-8 h-8 text-yellow-500 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z"/>
                </svg>
                <div class="text-left">
                    <p class="font-bold text-gray-900 dark:text-white">{{ __('pages.lander.hero.feature_fast_title') }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('pages.lander.hero.feature_fast_desc') }}</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-6 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
                <svg class="w-8 h-8 text-dscpics-500 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                </svg>
                <div class="text-left">
                    <p class="font-bold text-gray-900 dark:text-white">{{ __('pages.lander.hero.feature_secure_title') }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('pages.lander.hero.feature_secure_desc') }}</p>
                </div>
            </div>
        </div>
    </div>

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