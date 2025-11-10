@if ($latestLinks->isNotEmpty())
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
            {{ __('links.latest_short_links') }}
        </h3>
        <div
            class="overflow-x-auto bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md"
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
                    @foreach ($latestLinks as $link)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a
                                    href="{{ route('links.show', $link->slug) }}"
                                    target="_blank"
                                    class="text-sky-600 hover:underline dark:text-sky-400"
                                >
                                    {{ route('links.show', $link->slug) }}
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
                                    onclick="navigator.clipboard.writeText('{{ route('links.show', $link->slug) }}')"
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
    </div>
@else
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
            {{ __('links.no_links_yet') }}
        </h3>
        <div
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md p-6"
        >
            <p class="text-gray-700 dark:text-gray-300">
                {{ __('links.create_first_link') }}
            </p>
        </div>
    </div>
@endif