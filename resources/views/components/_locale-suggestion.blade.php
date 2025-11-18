@if(session()->has('suggested_locale') && session('suggested_locale') !== config('app.locale') && array_key_exists(session('suggested_locale'), config('app.locales', [])))
    <div id="locale-suggestion-banner" class="fixed inset-x-0 bottom-0 z-50 flex items-center justify-center bg-white/90 p-4 shadow-lg backdrop-blur-sm dark:border-t dark:border-gray-700 dark:bg-gray-800/90">
        <p class="text-md mr-4 text-gray-800 dark:text-gray-200">
            {{ __('content.language_suggestion', ['suggested_language' => config('app.locales')[session('suggested_locale')]]) }}
        </p>
        <div class="flex items-center space-x-3">
            <form action="{{ route('locale.apply') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-dscpics-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-all duration-200 hover:bg-dscpics-700 focus:outline-none focus:ring-2 focus:ring-dscpics-500 focus:ring-offset-2 dark:bg-dscpics-500 dark:hover:bg-dscpics-600">
                    {{__('Apply')}}
                </button>
            </form>
            <form action="{{ route('locale.dismiss') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all duration-200 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-dscpics-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    {{__('Dismiss')}}
                </button>
            </form>
            <button id="close-locale-suggestion" class="rounded-md p-2 text-gray-400 transition-all duration-200 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-dscpics-500 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                <span class="sr-only">{{__('Close')}}</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        document.getElementById('close-locale-suggestion').addEventListener('click', function() {
            document.getElementById('locale-suggestion-banner').style.display = 'none';
        });
    </script>
@endif