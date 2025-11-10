<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        {{ __('content.storage_used') }}
    </label>
    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4">
        <!--div class="bg-dscpics-500 h-4 rounded-full transition-all duration-300" style="width: {{ auth()->user()->storage_percentage }}%"></div-->
        <div class="bg-sky-500 h-4 rounded-full transition-all duration-300" style="width: {{ auth()->user()->storage_percentage }}%"></div>
    </div>
    <p class="text-sm mt-1 text-gray-600 dark:text-gray-400">
        {{ auth()->user()->storage_used_mb }} MB /
        {{ auth()->user()->storage_limit_mb }} MB
    </p>
</div>