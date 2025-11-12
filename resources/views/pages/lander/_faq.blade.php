<section id="faq" class="py-20 bg-white dark:bg-gray-900">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2
                class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4"
            >
                {{ __('pages.lander.faq.title') }}
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">
                {{ __('pages.lander.faq.subtitle') }}
            </p>
        </div>

        <div x-data="{ openFaq: null }" class="space-y-4">
            @foreach(__('pages.lander.faq.questions') as $index => $faq)
                <div
                    class="border rounded-2xl shadow-sm dark:shadow-lg overflow-hidden"
                    :class="{
                        'border-gray-200 dark:border-gray-800': openFaq !== {{ $index }},
                        'border-dscpics-200 dark:border-dscpics-700': openFaq === {{ $index }}
                    }"
                >
                    <button
                        @click="openFaq = (openFaq === {{ $index }} ? null : {{ $index }})"
                        class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 transition-all duration-300 ease-in-out"
                        :class="{
                            'bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800': openFaq !== {{ $index }},
                            'bg-dscpics-100 dark:bg-dscpics-900 hover:bg-dscpics-200 dark:hover:bg-dscpics-800': openFaq === {{ $index }}
                        }"
                    >
                        <span
                            class="text-lg font-semibold"
                            :class="{
                                'text-gray-900 dark:text-white': openFaq !== {{ $index }},
                                'text-dscpics-800 dark:text-dscpics-100': openFaq === {{ $index }}
                            }"
                        >
                            {{ $faq['question'] }}
                        </span>
                        <svg
                            class="w-6 h-6 transition-transform duration-300 flex-shrink-0"
                            :class="{
                                'rotate-180 text-dscpics-600 dark:text-dscpics-300': openFaq === {{ $index }},
                                'text-gray-500 dark:text-gray-400': openFaq !== {{ $index }}
                            }"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div
                        x-show="openFaq === {{ $index }}"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2"
                        class="px-6 pb-6 pt-2"
                    >
                        <p
                            class="text-base leading-relaxed"
                            :class="{
                                'text-gray-700 dark:text-gray-300': openFaq !== {{ $index }},
                                'text-dscpics-700 dark:text-dscpics-200': openFaq === {{ $index }}
                            }"
                        >
                            {{ $faq['answer'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>