@if($mediaItems->count())
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($mediaItems as $media)
            @php
                $viewRoute = Str::startsWith($media->mime, 'video/')
                    ? route('vid.show.slug', $media)
                    : route('img.show.slug', $media)
            @endphp

            <div x-data="{ showCopyModal: false, showDeleteModal: false }"
                 class="group relative border-0 rounded-lg shadow-sm bg-white dark:bg-gray-800 overflow-hidden flex flex-col justify-between transition-all duration-200 hover:shadow-md dark:hover:shadow-lg">

                <div class="relative w-full aspect-video flex items-center justify-center bg-gray-100 dark:bg-gray-900 rounded-t-lg">
                    @if(Str::startsWith($media->mime, 'video/'))
                        <video controls class="absolute inset-0 w-full h-full object-contain rounded-t-lg">
                            <source src="{{ $viewRoute }}" type="{{ $media->mime }}">
                            {{ __('content.video_not_supported') }}
                        </video>
                    @else
                        <img src="{{ $viewRoute }}"
                             alt="{{ $media->original_name }}"
                             class="absolute inset-0 w-full h-full object-contain rounded-t-lg">
                    @endif
                </div>

                <div class="p-3 flex flex-col flex-grow">
                    <div class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate mb-2" title="{{ $media->original_name }}">
                        {{ $media->original_name }}
                    </div>

                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                        {{ __('content.views_count', ['count' => $media->getViewCount()]) }}
                    </div>

                    <div class="flex-grow"></div>
                    <div class="grid grid-cols-2 gap-2 text-sm mt-2">

                        <a href="{{ $viewRoute }}" target="_blank"
                           class="inline-flex items-center justify-center p-2 rounded-md bg-blue-50 text-blue-700 hover:bg-blue-100 dark:bg-blue-800 dark:text-blue-100 dark:hover:bg-blue-700 transition">
                            <i class="bi bi-eye mr-1"></i> {{ __('content.view') }}
                        </a>

                        <button
                            @click="navigator.clipboard.writeText('{{ $viewRoute }}').then(() => { showCopyModal = true })"
                            type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition"
                            title="{{ __('content.copy_link_title') }}">
                            <i class="bi bi-clipboard mr-1"></i> {{ __('content.copy_link') }}
                        </button>

                        @if(auth()->id() === $media->user_id)
                            <button
                                @click="showDeleteModal = true"
                                type="button"
                                class="inline-flex items-center justify-center p-2 rounded-md bg-red-50 text-red-700 hover:bg-red-100 dark:bg-red-800 dark:text-red-100 dark:hover:bg-red-700 transition">
                                <i class="bi bi-trash mr-1"></i> {{ __('content.delete') }}
                            </button>

                            <form method="POST" action="{{ route('media.toggleVisibility', $media) }}" class="col-span-1">
                                @csrf
                                @method('PATCH')
                                <select name="is_public" onchange="this.form.submit()"
                                        class="w-full text-sm border-gray-300 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 focus:ring-dscpics-500 focus:border-dscpics-500 p-2 pr-8 transition
                                               dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:ring-dscpics-400 dark:focus:border-dscpics-400">
                                    <option value="0" {{ !$media->is_public ? 'selected' : '' }}>{{ __('content.private') }}</option>
                                    <option value="1" {{ $media->is_public ? 'selected' : '' }}>{{ __('content.public') }}</option>
                                </select>
                            </form>
                        @endif
                    </div>
                </div>

                <div x-show="showCopyModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90"
                     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50 p-4"
                     @click.away="showCopyModal = false">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-xs w-full p-6 text-center">
                        <p class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">{{ __('content.link_copied') }}</p>
                        <button @click="showCopyModal = false"
                                class="px-5 py-2 bg-dscpics-600 text-white rounded-lg hover:bg-dscpics-700 transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-dscpics-500 focus:ring-offset-2
                                       dark:bg-dscpics-500 dark:hover:bg-dscpics-600 dark:focus:ring-dscpics-400">
                            {{ __('content.close') }}
                        </button>
                    </div>
                </div>

                <div x-show="showDeleteModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90"
                     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50 p-4"
                     @click.away="showDeleteModal = false">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-sm w-full p-8">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ __('content.delete_question_media') }}</h3>
                        <p class="mb-6 text-gray-600 dark:text-gray-400 truncate text-base" title="{{ $media->original_name }}">
                            {{ $media->original_name }}
                        </p>

                        <div class="flex justify-end space-x-3 mt-6">
                            <button @click="showDeleteModal = false"
                                    class="px-5 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2
                                           dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:focus:ring-gray-500">
                                {{ __('content.cancel') }}
                            </button>

                            <form method="POST" action="{{ route('media.destroy', $media) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2
                                               dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-600">
                                    {{ __('content.delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 flex justify-center">
        {{ $mediaItems->links('components.custom-pagination') }}
    </div>
@else
    <p class="text-gray-500 dark:text-gray-400 text-center py-8">{{ __('content.no_media_yet') }}</p>
@endif