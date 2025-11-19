<div class="flex justify-between items-center">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
        {{ __('api.token_management') }}
    </h2>
    <a href="{{ route('profile.api-tokens.index') }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">
        {{ __('profile.manage') }} &rarr;
    </a>
</div>
