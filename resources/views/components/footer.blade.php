<footer class="text-center text-sm text-gray-500 mt-10 py-6 border-t border-gray-300 dark:text-gray-400 dark:border-gray-700">
    <p>
        &copy; {{ date('Y') }} {{ env('APP_NAME', 'DCPic.eu') }}
        {{ __('content.by') }}
        <a href="https://fternis.de" target="_blank" rel="noopener noreferrer" class="underline hover:text-dscpics-500">fternis.de</a> 
        ( 
        <a href="https://michaelninder.de" target="_blank" rel="noopener noreferrer" class="underline hover:text-dscpics-500">michaelninder.de</a>
		)
        {{ __('content.from') }}
        <a href="https://europehost.eu" target="_blank" rel="noopener noreferrer" class="underline hover:text-dscpics-500">EuropeHost.eu</a> 
        {{ __('content.by') }}
        <a href="https://xpsystems.eu" target="_blank" rel="noopener noreferrer" class="underline hover:text-dscpics-500">xpsystems.eu</a> 
        — All Rights Reserved.
    </p>

    <div class="flex justify-center space-x-6 mt-3 text-gray-600 dark:text-gray-300">
        @if(env('DISCORD_SERVER_INVITE'))
            <a href="{{ env('DISCORD_SERVER_INVITE') }}" target="_blank" rel="noopener noreferrer" class="hover:text-dscpics-600" aria-label="Discord Server">
                <i class="bi bi-discord text-xl"></i>
            </a>
        @endif

        @if(env('GITHUB_LINK'))
            <a href="{{ env('GITHUB_LINK') }}" target="_blank" rel="noopener noreferrer" class="hover:text-gray-800 dark:hover:text-gray-100" aria-label="GitHub">
                <i class="bi bi-github text-xl"></i>
            </a>
        @endif

        @if(env('TWITTER_LINK'))
            <a href="{{ env('TWITTER_LINK') }}" target="_blank" rel="noopener noreferrer" class="hover:text-dscpics-500" aria-label="Twitter">
                <i class="bi bi-twitter text-xl"></i>
            </a>
        @endif

    </div>

	<div class="mt-4 text-xs text-gray-600 dark:text-gray-300">
        @foreach(config('app.legal_sections') as $section)
            <a href="{{ route('pages.legal', $section) }}" class="hover:underline hover:text-dscpics-500">
                {{ __('legal.' . $section . '.title') }}
            </a>
            @if(!$loop->last)
                <span class="mx-1">|</span>
            @endif
        @endforeach
	</div>
</footer>
