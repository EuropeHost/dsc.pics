<nav
    class="px-4 py-3 flex justify-between items-center {{ isset($glassyNavbar) && $glassyNavbar ? 'bg-white/50 backdrop-blur-lg dark:bg-gray-800/50' : 'bg-white shadow-md dark:bg-gray-800 dark:shadow-lg' }} {{ isset($stickyNavbar) && $stickyNavbar ? 'sticky top-0 z-50' : '' }} {{ isset($floatingNavbar) && $floatingNavbar ? 'absolute top-4 left-0 right-0 mx-16 rounded-lg' : '' }}"
>
    <a
        href="{{ route('home') }}"
        class="text-lg font-bold text-dscpics-600 duration-255 hover:text-dscpics-500 dark:text-dscpics-400 dark:hover:text-dscpics-300"
    >
        {{ env('APP_NAME') }}
    </a>

    <div class="flex items-center space-x-3">
        @auth
            @php
                $user = auth()->user();
                $discordId = $user->discord_id;
                $avatarHash = $user->avatar;

                $avatarUrl = asset('img/default-avatar.png');
                if ($discordId && $avatarHash) {
                    $avatarUrl =
                        "https://cdn.discordapp.com/avatars/{$discordId}/{$avatarHash}.png";
                }
            @endphp

            <div class="hidden md:flex items-center space-x-4">
                <a
                    href="{{ route('media.my') }}"
                    class="text-gray-700 duration-255 hover:text-dscpics-600 font-medium flex items-center space-x-1 dark:text-gray-200 dark:hover:text-dscpics-400"
                >
                    <i class="bi bi-images"></i>
                    <span>{{ __('content.my_media') }}</span>
                </a>

                <a
                    href="{{ route('media.recent') }}"
                    class="text-gray-700 duration-255 hover:text-dscpics-600 font-medium flex items-center space-x-1 dark:text-gray-200 dark:hover:text-dscpics-400"
                >
                    <i class="bi bi-clock-history"></i>
                    <span>{{ __('content.recent_uploads') }}</span>
                </a>
                @if ($user->role === 'admin') @endif
            </div>
        @endauth

        @include('components.theme-toggle')

        @include('components.locale-switcher')

        @include('components.user-dropdown')
    </div>
</nav>