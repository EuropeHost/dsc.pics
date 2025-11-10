<div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg border border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center sm:items-start">
    <img
        src="{{ $user->avatar_url }}"
        alt="{{ $user->name }}"
        class="w-28 h-28 rounded-full object-cover border-4 border-sky-500 dark:border-sky-400 mr-6 mb-4 sm:mb-0 shadow-lg"
    />
    <div>
        <p class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">
            {{ __('profile.username') }}:
            <span class="font-normal text-gray-700 dark:text-gray-300">{{ $user->name }}</span>
        </p>
        <p class="text-md text-gray-600 dark:text-gray-400 mb-1">
            {{ __('profile.user_id') }}:
            <span class="font-mono text-gray-800 dark:text-gray-200">{{ $user->id }}</span>
        </p>
        <p class="text-md text-gray-600 dark:text-gray-400 mb-1">
            {{ __('profile.discord_id') }}:
            <span class="font-mono text-gray-800 dark:text-gray-200">{{ $user->discord_id }}</span>
        </p>
        <p class="text-md text-gray-600 dark:text-gray-400 transition-all duration-300">
            {{ __('profile.email') }}:
            <span
                :class="{ 'filter blur-sm': !emailHover }"
                @mouseenter="emailHover = true"
                @mouseleave="emailHover = false"
                class="text-gray-800 dark:text-gray-200"
            >
                {{ $user->email }}
            </span>
        </p>
        <p class="text-md text-gray-600 dark:text-gray-400 mt-2">
            {{ __('profile.account_created') }}:
            <span class="text-gray-800 dark:text-gray-200">
                {{ $user->created_at->format('M d, Y H:i') }}
            </span>
        </p>
    </div>
</div>