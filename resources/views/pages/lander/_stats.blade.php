<section id="stats" class="py-20 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
                {{ __('pages.lander.stats.title') }}
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">
                {{ __('pages.lander.stats.subtitle') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-8 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 rounded-lg bg-dscpics-100 dark:bg-dscpics-900/30">
                        <svg class="w-8 h-8 text-dscpics-600 dark:text-dscpics-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('pages.lander.stats.users') }}</h3>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('pages.lander.stats.total') }}</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['users']['total']) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_month') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($stats['users']['month']) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_week') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($stats['users']['week']) }}</span>
                    </div>
                </div>
            </div>

            <div class="p-8 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('pages.lander.stats.media') }}</h3>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('pages.lander.stats.total') }}</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['media']['total']) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_month') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($stats['media']['month']) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_week') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($stats['media']['week']) }}</span>
                    </div>
                </div>
            </div>

            <div class="p-8 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 rounded-lg bg-green-100 dark:bg-green-900/30">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('pages.lander.stats.links') }}</h3>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('pages.lander.stats.total') }}</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['links']['total']) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_month') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($stats['links']['month']) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_week') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($stats['links']['week']) }}</span>
                    </div>
                </div>
            </div>

            <div class="p-8 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 rounded-lg bg-orange-100 dark:bg-orange-900/30">
                        <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('pages.lander.stats.media_views') }}</h3>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('pages.lander.stats.total') }}</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['media_views']['total']) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_month') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($stats['media_views']['month']) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_week') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($stats['media_views']['week']) }}</span>
                    </div>
                </div>
            </div>

            <div class="p-8 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-900/30">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('pages.lander.stats.link_views') }}</h3>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('pages.lander.stats.total') }}</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['link_views']['total']) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_month') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($stats['link_views']['month']) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_week') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($stats['link_views']['week']) }}</span>
                    </div>
                </div>
            </div>

            <div class="p-8 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 rounded-lg bg-red-100 dark:bg-red-900/30">
                        <svg class="w-8 h-8 text-red-600 dark:text-red-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('pages.lander.stats.storage') }}</h3>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('pages.lander.stats.total') }}</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">
                            @php
                                $bytes = $stats['storage_use']['total'];
                                $units = ['B', 'KB', 'MB', 'GB', 'TB'];
                                for ($i = 0; $bytes > 1024 && $i < 4; $i++) {
                                    $bytes /= 1024;
                                }
                                echo round($bytes, 2) . ' ' . $units[$i];
                            @endphp
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_month') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">
                            @php
                                $bytes = $stats['storage_use']['month'];
                                $units = ['B', 'KB', 'MB', 'GB', 'TB'];
                                for ($i = 0; $bytes > 1024 && $i < 4; $i++) {
                                    $bytes /= 1024;
                                }
                                echo round($bytes, 2) . ' ' . $units[$i];
                            @endphp
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-500">{{ __('pages.lander.stats.this_week') }}</span>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">
                            @php
                                $bytes = $stats['storage_use']['week'];
                                $units = ['B', 'KB', 'MB', 'GB', 'TB'];
                                for ($i = 0; $bytes > 1024 && $i < 4; $i++) {
                                    $bytes /= 1024;
                                }
                                echo round($bytes, 2) . ' ' . $units[$i];
                            @endphp
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>