<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
        {{ __('content.your_stats') }}
    </h3>
    <p class="text-gray-700 dark:text-gray-300 mb-2">
        {{ __('content.total_media_uploaded') }}:
        <span class="font-medium">{{ auth()->user()->media()->count() }}</span>
    </p>
    <p class="text-gray-700 dark:text-gray-300 mb-2">
        {{ __('content.total_links_shortened') }}:
        <span class="font-medium">{{ auth()->user()->links()->count() }}</span>
    </p>
    <p class="text-gray-700 dark:text-gray-300 mb-2">
        {{ __('content.total_link_views') }}:
        <span class="font-medium">{{ number_format($totalUserLinkViews) }}</span>
    </p>
    <p class="text-gray-700 dark:text-gray-300">
        {{ __('content.account_created') }}:
        <span class="font-medium">{{ auth()->user()->created_at->format('M d, Y') }}</span>
    </p>
</div>