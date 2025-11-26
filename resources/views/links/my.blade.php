@extends('layouts.main')

@section('main')
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">
            {{ __('links.my_short_links') }}
        </h1>

        <div class="mb-8">
            @include('pages.partials.link-shorten')
        </div>

        @if ($links->isNotEmpty())
            <div
                class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm"
            >
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                {{ __('links.short_link') }}
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                {{ __('links.original_link') }}
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                {{ __('links.visits') }}
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                {{ __('links.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700"
                    >
                        @foreach ($links as $link)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a
                                        href="{{ route('links.show', $link->slug) }}"
                                        target="_blank"
                                        class="text-sky-600 hover:underline dark:text-sky-400"
                                    >
                                        {{ env('APP_URL') }}/l/{{ $link->slug }}
                                    </a>
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 truncate"
                                    title="{{ $link->original_url }}"
                                >
                                    {{ $link->original_url }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                >
                                    {{ number_format($link->views_count) }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <button
                                        onclick="
                                            if (navigator.clipboard) {
                                                navigator.clipboard.writeText('{{ route('links.show', $link->slug) }}')
                                                    .then(() => {
                                                        window.showToast('success', '{{ __('content.toast_messages.copied_item', ['item' => __('links.short_link')]) }}');
                                                    })
                                                    .catch(() => {
                                                        window.showToast('error', '{{ __('content.toast_messages.copy_item_failed', ['item' => __('links.short_link')]) }}');
                                                    });
                                            } else {
                                                window.showToast('error', '{{ __('content.toast_messages.copy_not_supported') }}');
                                            }
                                        "
                                        class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600 mr-3"
                                    >
                                        {{ __('links.copy') }}
                                    </button>
                                    <form
                                        action="{{ route('links.destroy', $link) }}"
                                        method="POST"
                                        class="inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600"
                                        >
                                            {{ __('links.delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $links->links('components.custom-pagination') }}
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">
                {{ __('links.no_links_yet') }}
            </p>
        @endif
    </div>
@endsection