@if(session()->has('suggested_locale') && session('suggested_locale') !== config('app.locale') && array_key_exists(session('suggested_locale'), config('app.locales', [])))
    <!-- Mobile / Small Screens: Full-width bottom banner -->
    <div id="locale-suggestion-mobile-banner" class="fixed inset-x-0 bottom-0 z-[100] flex items-center justify-between bg-white/90 p-4 shadow-lg backdrop-blur-sm dark:border-t dark:border-gray-700 dark:bg-gray-800/90 sm:hidden">
        <p class="text-sm text-gray-800 dark:text-gray-200">
            {!! __('content.language_suggestion', ['suggested_language' => '<span class="font-bold text-dscpics-600 dark:text-dscpics-400">' . config('app.locales')[session('suggested_locale')] . '</span>']) !!}
        </p>
        <div class="flex space-x-2">
            <form action="{{ route('locale.apply') }}" method="POST">
                @csrf
                <button type="submit" class="rounded-md bg-dscpics-600 px-3 py-1.5 text-sm font-medium text-white shadow-sm hover:bg-dscpics-700 dark:bg-dscpics-500 dark:hover:bg-dscpics-600">
                    {{__('Apply')}}
                </button>
            </form>
            <button id="dismiss-locale-mobile" class="rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                {{__('Dismiss')}}
            </button>
        </div>
    </div>

    <!-- Desktop / Larger Screens: Top-right toast -->
    <div
        id="locale-suggestion-desktop-toast"
        x-data="{ show: true }"
        x-show="show"
        x-transition:enter="slide-in"
        x-transition:leave="slide-out"
        class="fixed right-5 top-24 z-[100] hidden w-full max-w-sm rounded-lg border border-gray-200 bg-white p-4 shadow-lg dark:border-gray-700 dark:bg-gray-800 sm:block"
        role="alert"
    >
        <div class="flex items-start">
            <div class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-700 dark:text-blue-200">
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                </svg>
                <span class="sr-only">Info icon</span>
            </div>
            <div class="ms-3 text-sm font-normal text-gray-700 dark:text-gray-300">
                <p class="mb-2">
                    {!! __('content.language_suggestion', ['suggested_language' => '<span class="font-bold text-dscpics-600 dark:text-dscpics-400">' . config('app.locales')[session('suggested_locale')] . '</span>']) !!}
                </p>
                <div class="flex space-x-2">
                    <form action="{{ route('locale.apply') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex rounded-lg bg-dscpics-600 px-3 py-1.5 text-center text-xs font-medium text-white hover:bg-dscpics-700 focus:outline-none focus:ring-4 focus:ring-dscpics-300 dark:bg-dscpics-500 dark:hover:bg-dscpics-600 dark:focus:ring-dscpics-800">
                            {{__('Apply')}}
                        </button>
                    </form>
                    <form action="{{ route('locale.dismiss') }}" method="POST">
                        @csrf
                        <button type="submit" @click="show = false" class="inline-flex rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-center text-xs font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                            {{__('Dismiss')}}
                        </button>
                    </form>
                </div>
            </div>
            <button type="button" @click="show = false" class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>

    <script>
        document.getElementById('dismiss-locale-mobile').addEventListener('click', function() {
            fetch("{{ route('locale.dismiss') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById('locale-suggestion-mobile-banner').style.display = 'none';
                }
            })
            .catch(error => console.error('Error dismissing locale:', error));
        });
    </script>
@endif