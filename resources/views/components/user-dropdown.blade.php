@auth
    @php
        $user = auth()->user();
        $discordId = $user->discord_id;
        $avatarHash = $user->avatar;

        $avatarUrl = asset('img/default-avatar.png');
        if ($discordId && $avatarHash) {
            $avatarUrl = "https://cdn.discordapp.com/avatars/{$discordId}/{$avatarHash}.png";
        }
    @endphp
    <div x-data="{ open: false }" class="relative z-30">
        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none px-2 py-1 rounded-md duration-255 hover:bg-gray-100 transition dark:text-gray-200 dark:hover:bg-gray-700">
            <img src="{{ $avatarUrl }}" alt="User Avatar"
                class="rounded-full w-8 h-8 object-cover border border-gray-200 dark:border-gray-700">
            <span class="hidden md:inline text-gray-700 font-medium dark:text-gray-200">{{ $user->name }}</span>
            <i class="bi bi-chevron-down text-xs"></i>
        </button>

        <div x-show="open" @click.away="open = false" x-transition.origin.top-right
             class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50 overflow-hidden dark:bg-gray-700 dark:border-gray-600">
            <a href="{{ route('dashboard') }}"
                class="block text-gray-700 duration-255 hover:bg-gray-100 hover:text-dscpics-600 font-medium flex items-center space-x-2 text-sm px-4 py-2 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-dscpics-400">
                <i class="bi bi-speedometer"></i>
                <span>{{ __('content.dashboard') }}</span>
            </a>
            <a href="{{ route('profile.show') }}"
                class="block text-gray-700 duration-255 hover:bg-gray-100 hover:text-dscpics-600 font-medium flex items-center space-x-2 text-sm px-4 py-2 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-dscpics-400">
                <i class="bi bi-person"></i>
                <span>{{ __('profile.my_profile') }}</span>
            </a>
            <div class="md:hidden">
                <a href="{{ route('media.my') }}"
                    class="block text-gray-700 duration-255 hover:bg-gray-100 hover:text-dscpics-600 font-medium flex items-center space-x-2 text-sm px-4 py-2 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-dscpics-400">
                    <i class="bi bi-images"></i>
                    <span>{{ __('content.my_media') }}</span>
                </a>

                <a href="{{ route('media.recent') }}"
                    class="block text-gray-700 duration-255 hover:bg-gray-100 hover:text-dscpics-600 font-medium flex items-center space-x-2 text-sm px-4 py-2 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-dscpics-400">
                    <i class="bi bi-clock-history"></i>
                    <span>{{ __('content.recent_uploads') }}</span>
                </a>
            </div>
			
			@if ($user->role === 'admin')
			    <a href="{{ route('admin.dashboard') }}"
			        class="block text-gray-700 duration-255 hover:bg-gray-100 hover:text-dscpics-600 font-medium flex items-center space-x-2 text-sm px-4 py-2 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-dscpics-400">
			        <i class="bi bi-speedometer"></i>
			        <span>{{ __('admin.admin_dashboard') }}</span>
			    </a>
			@endif
			
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-4 py-2 duration-255 hover:bg-gray-100 text-sm text-red-500 text-left dark:text-red-400 dark:hover:bg-gray-600">
                    <i class="bi bi-box-arrow-right mr-2"></i> {{ __('content.logout') }}
                </button>
            </form>
        </div>
    </div>
@else
    <a href="{{ route('login') }}"
        class="text-dscpics-600 duration-255 hover:underline flex items-center space-x-1 dark:text-dscpics-400 dark:hover:text-dscpics-300">
        <i class="bi bi-discord"></i>
        <span>{{ __('content.login') }}</span>
    </a>
@endauth
