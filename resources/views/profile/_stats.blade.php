<div
    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 bg-gray-50 dark:bg-gray-900 p-6 rounded-lg border border-gray-200 dark:border-gray-700"
>
    <div class="rounded-lg p-5 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm">
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
            {{ __('profile.total_uploads') }}
        </p>
        <p class="text-3xl font-bold text-sky-600 dark:text-sky-400 mt-2">
            {{ number_format($user->media_count) }}
        </p>
    </div>

    <div class="rounded-lg p-5 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm">
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
            {{ __('profile.public_uploads') }}
        </p>
        <p class="text-3xl font-bold text-sky-600 dark:text-sky-400 mt-2">
            {{ number_format($publicMediaCount) }}
        </p>
    </div>

    <div class="rounded-lg p-5 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm">
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
            {{ __('profile.private_uploads') }}
        </p>
        <p class="text-3xl font-bold text-sky-600 dark:text-sky-400 mt-2">
            {{ number_format($privateMediaCount) }}
        </p>
    </div>

    <div class="rounded-lg p-5 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm">
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
            {{ __('profile.storage_used') }}
        </p>
        <p class="text-3xl font-bold text-sky-600 dark:text-sky-400 mt-2">
            {{ number_format($user->media_sum_size / 1024 / 1024, 2) }} MB
        </p>
    </div>
</div>