<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
    <h2
        class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4"
    >
        {{ __('content.upload_media') }}
    </h2>
    <form
        action="{{ route('media.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        <div
            class="flex flex-col md:flex-row items-center md:space-x-3 space-y-3 md:space-y-0"
        >
            <label
                class="block cursor-pointer bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-200 ease-in-out text-sm flex-shrink-0"
            >
                <span id="fileName">{{ __('content.choose_file') }}</span>
                <input
                    type="file"
                    name="file"
                    id="fileInput"
                    accept="image/*,video/mp4"
                    required
                    class="hidden"
                />
            </label>
            <small class="text-xs text-gray-500 dark:text-gray-400">
                {{ __('Only .mp4 videos and images (JPG, PNG, GIF, WebP) are allowed. Max size: :max MB.', ['max' => env('MAX_FILE_SIZE', 50)]) }}
            </small>

            <select
                name="is_public"
                class="block w-full md:w-auto border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-dscpics-500 dark:focus:border-dscpics-600 focus:ring-dscpics-500 dark:focus:ring-dscpics-600 rounded-md shadow-sm text-sm"
            >
                <option value="0">{{ __('content.private') }}</option>
                <option value="1">{{ __('content.public') }}</option>
            </select>

            <button
                type="submit"
                class="bg-dscpics-500 text-white px-4 py-2 rounded-lg hover:bg-dscpics-600 duration-255 transition text-sm flex-shrink-0"
            >
                <i class="bi bi-upload"></i> {{ __('content.upload') }}
            </button>
        </div>
    </form>
</div>