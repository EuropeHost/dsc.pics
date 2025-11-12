@if ($latestMedia->isNotEmpty())
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
            {{ __('content.latest_uploads') }}
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($latestMedia as $media)
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md p-4 relative overflow-hidden flex flex-col items-center"
                >
                    @if (Str::startsWith($media->mime, 'video/'))
                        <video
                            controls
                            class="max-w-full max-h-48 h-auto rounded-lg mb-4 object-cover"
                        >
                            <source
                                src="{{ route('vid.show.slug', $media) }}"
                                type="{{ $media->mime }}"
                            />
                            {{ __('content.video_not_supported') }}
                        </video>
                    @else
                        <img
                            src="{{ route('img.show.slug', $media) }}"
                            class="max-w-full max-h-48 h-auto object-contain rounded-lg mb-4"
                            alt="{{ $media->original_name }}"
                        />
                    @endif

                    <div class="flex flex-wrap justify-center gap-x-3 text-xs text-gray-600 dark:text-gray-400">
                        <span>{{ $media->created_at->diffForHumans() }}</span>
                        <span>&bull;</span>
                        <span>{{ number_format($media->size / 1024 / 1024, 2) }} MB</span>
                        <span>&bull;</span>
                        <span
                            class="{{ $media->is_public ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}"
                        >
                            {{ $media->is_public ? __('content.public') : __('content.private') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex flex-wrap space-x-4 text-sm mt-6 justify-center">
            <a
                href="{{ route('media.my') }}"
                class="text-dscpics-600 hover:underline dark:text-dscpics-400"
            >
                {{ __('content.see_my_media') }}
            </a>
            <a
                href="{{ route('media.recent') }}"
                class="text-dscpics-600 hover:underline dark:text-dscpics-400"
            >
                {{ __('content.see_recent_media') }}
            </a>
            <a
                href="{{ route('links.my') }}"
                class="text-dscpics-600 hover:underline dark:text-dscpics-400"
            >
                {{ __('links.my_short_links') }}
            </a>
        </div>
    </div>
@else
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
            {{ __('content.no_uploads') }}
        </h3>
        <div
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md p-6"
        >
            <p class="text-gray-700 dark:text-gray-300">
                {{ __('content.upload_first') }}
            </p>
        </div>
    </div>
@endif