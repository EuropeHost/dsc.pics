@if ($paginator->hasPages())
    <nav class="flex justify-center mt-6">
        <ul class="flex items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    <span
                        class="px-3 py-2 text-sm font-medium text-gray-500 bg-gray-100 dark:bg-gray-700 dark:text-gray-400 rounded-md cursor-not-allowed"
                        aria-hidden="true"
                        >&lsaquo;</span
                    >
                </li>
            @else
                <li>
                    <a
                        href="{{ $paginator->previousPageUrl() }}"
                        rel="prev"
                        aria-label="{{ __('pagination.previous') }}"
                        class="px-3 py-2 text-sm font-medium text-sky-600 dark:text-sky-400 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                        >&lsaquo;</a
                    >
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li aria-disabled="true">
                        <span
                            class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-md"
                            >{{ $element }}</span
                        >
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span
                                    class="px-3 py-2 text-sm font-medium text-white bg-sky-600 dark:bg-sky-500 rounded-md shadow-sm"
                                    >{{ $page }}</span
                                >
                            </li>
                        @else
                            <li>
                                <a
                                    href="{{ $url }}"
                                    class="px-3 py-2 text-sm font-medium text-sky-600 dark:text-sky-400 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                                    >{{ $page }}</a
                                >
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a
                        href="{{ $paginator->nextPageUrl() }}"
                        rel="next"
                        aria-label="{{ __('pagination.next') }}"
                        class="px-3 py-2 text-sm font-medium text-sky-600 dark:text-sky-400 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                        >&rsaquo;</a
                    >
                </li>
            @else
                <li aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    <span
                        class="px-3 py-2 text-sm font-medium text-gray-500 bg-gray-100 dark:bg-gray-700 dark:text-gray-400 rounded-md cursor-not-allowed"
                        aria-hidden="true"
                        >&rsaquo;</span
                    >
                </li>
            @endif
        </ul>
    </nav>
@endif