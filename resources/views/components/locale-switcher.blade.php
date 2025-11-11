<div x-data="{ open: false }" class="relative z-20">
    <button @click="open = !open" class="flex items-center text-sm focus:outline-none px-1 py-1 rounded-md duration-255 hover:bg-gray-100 transition dark:text-gray-200 dark:hover:bg-gray-700">
        <img src="{{ asset('img/SetLocale/' . app()->getLocale() . '.png') }}"
             class="w-7 h-5 mr-1" alt="{{ config('app.locales')[app()->getLocale()] ?? app()->getLocale() }}">
        <i class="bi bi-chevron-down text-xs"></i>
    </button>

    <div x-show="open" @click.away="open = false" x-transition.origin.top-right
         class="absolute right-0 mt-2 w-30 bg-white border border-gray-200 rounded-lg shadow-lg z-50 overflow-hidden dark:bg-gray-700 dark:border-gray-600">
        @foreach(config('app.locales') as $localeCode => $localeName)
            @if($localeCode !== app()->getLocale())
                <form method="POST" action="{{ route('set-locale') }}">
                    @csrf
                    <input type="hidden" name="locale" value="{{ $localeCode }}">
                    <button type="submit" class="flex items-center px-3 py-2 duration-255 hover:bg-gray-100 text-sm w-full text-left dark:text-gray-200 dark:hover:bg-gray-600">
                        <img src="{{ asset('img/SetLocale/' . $localeCode . '.png') }}" class="w-7 h-5 mr-1" alt="{{ $localeName }}">
                        {{ $localeName }}
                    </button>
                </form>
            @endif
        @endforeach
    </div>
</div>
