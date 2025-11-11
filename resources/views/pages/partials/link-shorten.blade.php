<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
        {{ __('links.create_new_short_link') }}
    </h2>
    <form action="{{ route('links.store') }}" method="POST">
        @csrf
        <div class="flex flex-col md:flex-row items-start md:space-x-4 space-y-4 md:space-y-0">
            <div class="flex-grow w-full md:w-1/2">
                <label
                    for="original_url"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                >
                    {{ __('links.original_url') }}
                </label>
                <input
                    name="original_url"
                    id="original_url"
                    placeholder="https://example.com/your-long-url-here"
                    class="w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-500 focus:ring-opacity-50 px-4 py-2"
                />
                @error('original_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2">
                <label
                    for="custom_slug"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                >
                    {{ __('links.custom_slug_optional') }}
                </label>
                <input
                    type="text"
                    name="custom_slug"
                    id="custom_slug"
                    placeholder="yourcustomlink"
                    class="w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-500 focus:ring-opacity-50 px-4 py-2"
                />
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('links.slug_requirements') }}
                </p>
                @error('custom_slug')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-auto flex-shrink-0 pt-0 md:pt-7">
                <button
                    type="submit"
                    class="w-full md:w-auto bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 transition duration-200 ease-in-out text-sm"
                >
                    <i class="bi bi-link-45deg"></i> {{ __('links.shorten') }}
                </button>
            </div>
        </div>
    </form>
</div>