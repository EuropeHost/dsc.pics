<section id="features" class="py-20 bg-gray-50 dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
                {{ __('pages.lander.features.title') }}
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">
                {{ __('pages.lander.features.subtitle') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div
                class="p-8 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 transition-all duration-300 hover:border-dscpics-500 dark:hover:border-dscpics-400 hover:bg-dscpics-50 dark:hover:bg-dscpics-900/10"
            >
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 rounded-lg bg-dscpics-100 dark:bg-dscpics-900/30 flex-shrink-0">
                        <svg
                            class="w-8 h-8 text-dscpics-600 dark:text-dscpics-400"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('pages.lander.features.storage_limit.title') }}
                    </h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('pages.lander.features.storage_limit.description', ['amount' => env('USER_STORAGE_LIMIT', 100)]) }}
                </p>
            </div>

            <div
                class="p-8 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 transition-all duration-300 hover:border-yellow-500 dark:hover:border-yellow-400 hover:bg-yellow-50 dark:hover:bg-yellow-900/10"
            >
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex-shrink-0">
                        <svg
                            class="w-8 h-8 text-yellow-600 dark:text-yellow-400"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('pages.lander.features.instant_upload.title') }}
                    </h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('pages.lander.features.instant_upload.description') }}
                </p>
            </div>

            <div
                class="p-8 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 transition-all duration-300 hover:border-purple-500 dark:hover:border-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/10"
            >
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex-shrink-0">
                        <svg
                            class="w-8 h-8 text-purple-600 dark:text-purple-400"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"
                            />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('pages.lander.features.discord_integration.title') }}
                    </h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('pages.lander.features.discord_integration.description') }}
                </p>
            </div>

            <div
                class="p-8 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 transition-all duration-300 hover:border-green-500 dark:hover:border-green-400 hover:bg-green-50 dark:hover:bg-green-900/10"
            >
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 rounded-lg bg-green-100 dark:bg-green-900/30 flex-shrink-0">
                        <svg
                            class="w-8 h-8 text-green-600 dark:text-green-400"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('pages.lander.features.short_links.title') }}
                    </h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('pages.lander.features.short_links.description') }}
                </p>
            </div>

            <div
                class="p-8 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 transition-all duration-300 hover:border-blue-500 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/10"
            >
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex-shrink-0">
                        <svg
                            class="w-8 h-8 text-blue-600 dark:text-blue-400"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('pages.lander.features.free.title') }}
                    </h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('pages.lander.features.free.description') }}
                </p>
            </div>

            <div
                class="p-8 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 transition-all duration-300 hover:border-orange-500 dark:hover:border-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/10"
            >
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex-shrink-0">
                        <svg
                            class="w-8 h-8 text-orange-600 dark:text-orange-400"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('pages.lander.features.analytics.title') }}
                    </h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('pages.lander.features.analytics.description') }}
                </p>
            </div>
        </div>
    </div>
</section>