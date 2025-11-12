@extends('layouts.main')

@section('main')
    <div
        class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 mb-6"
        x-data="{
            emailHover: false,
            showRoleModal: false,
            newRole: '{{ $user->role }}',
            showDeleteUserModal: false,
            modalEmailHover: false
        }"
    >
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">
            {{ __('admin.user_details') }}
        </h1>

        <div
            class="flex flex-col sm:flex-row items-center sm:items-start mb-6 bg-gray-50 dark:bg-gray-900 p-6 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm"
        >
            <img
                src="{{ $user->avatar_url }}"
                alt="{{ $user->name }}"
                class="w-28 h-28 rounded-full object-cover border-4 border-dscpics-500 dark:border-dscpics-400 mr-6 mb-4 sm:mb-0 shadow-lg"
            />
            <div>
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-1">
                    {{ $user->name }}
                </h2>
                <p
                    class="text-md text-gray-600 dark:text-gray-400 transition-all duration-300 mb-1"
                    :class="{ 'filter blur-sm': !emailHover }"
                    @mouseenter="emailHover = true"
                    @mouseleave="emailHover = false"
                >
                    {{ $user->email }}
                </p>
                <p class="text-md text-gray-600 dark:text-gray-400 mb-1">
                    {{ __('admin.discord_id_label') }}:
                    <span class="font-mono text-gray-800 dark:text-gray-200">{{ $user->discord_id }}</span>
                </p>
                <p class="text-md text-gray-600 dark:text-gray-400 capitalize">
                    {{ __('admin.role') }}:
                    <span class="font-bold text-dscpics-700 dark:text-dscpics-400">{{ $user->role }}</span>
                    @if (auth()->user()->id !== $user->id)
                        <button
                            @click="showRoleModal = true"
                            class="text-blue-500 dark:text-blue-400 hover:underline ml-2 text-sm focus:outline-none"
                        >
                            <i class="bi bi-pencil-square"></i> {{ __('admin.change_role') }}
                        </button>
                    @endif
                </p>
                <p class="text-md text-gray-600 dark:text-gray-400">
                    {{ __('admin.account_created_on') }}:
                    <span class="text-gray-800 dark:text-gray-200">
                        {{ $user->created_at->format('M d, Y H:i') }}
                    </span>
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div
                class="bg-gray-50 dark:bg-gray-900 rounded-lg p-5 border border-gray-200 dark:border-gray-700 shadow-sm"
            >
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                    {{ __('admin.media_uploaded') }}
                </p>
                <p class="text-3xl font-bold text-dscpics-600 dark:text-dscpics-400 mt-1">
                    {{ number_format($user->media_count) }}
                </p>
            </div>
            <div
                class="bg-gray-50 dark:bg-gray-900 rounded-lg p-5 border border-gray-200 dark:border-gray-700 shadow-sm"
            >
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                    {{ __('admin.storage_used') }}
                </p>
                <p class="text-3xl font-bold text-dscpics-600 dark:text-dscpics-400 mt-1">
                    {{ number_format($user->media_sum_size / 1024 / 1024, 2) }} MB
                </p>
            </div>
            <div
                class="bg-gray-50 dark:bg-gray-900 rounded-lg p-5 border border-gray-200 dark:border-gray-700 shadow-sm"
            >
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                    {{ __('admin.links_shortened') }}
                </p>
                <p class="text-3xl font-bold text-dscpics-600 dark:text-dscpics-400 mt-1">
                    {{ number_format($user->links_count) }}
                </p>
            </div>
            <div
                class="bg-gray-50 dark:bg-gray-900 rounded-lg p-5 border border-gray-200 dark:border-gray-700 shadow-sm"
            >
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                    {{ __('admin.link_views') }}
                </p>
                <p class="text-3xl font-bold text-dscpics-600 dark:text-dscpics-400 mt-1">
                    {{ number_format($totalUserLinkViews) }}
                </p>
            </div>
        </div>

        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">
            {{ __('admin.user_media') }}
        </h3>
        @if ($userMedia->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($userMedia as $media)
                    @php
                        $viewRoute = Str::startsWith($media->mime, 'video/')
                            ? route('vid.show.slug', $media)
                            : route('img.show.slug', $media);
                    @endphp

                    <div
                        class="group relative border border-gray-200 dark:border-gray-700 rounded-lg shadow-md bg-white dark:bg-gray-800 overflow-hidden flex flex-col justify-between transition-all duration-200 hover:shadow-lg"
                    >
                        <div
                            class="relative w-full aspect-video flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-t-lg"
                        >
                            @if (Str::startsWith($media->mime, 'video/'))
                                <video
                                    controls
                                    class="absolute inset-0 w-full h-full object-contain rounded-t-lg"
                                >
                                    <source
                                        src="{{ $viewRoute }}"
                                        type="{{ $media->mime }}"
                                    />
                                    {{ __('content.video_not_supported') }}
                                </video>
                            @else
                                <img
                                    src="{{ $viewRoute }}"
                                    alt="{{ $media->original_name }}"
                                    class="absolute inset-0 w-full h-full object-contain rounded-t-lg"
                                />
                            @endif
                        </div>

                        <div class="p-4 flex flex-col flex-grow">
                            <div
                                class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate mb-3"
                                title="{{ $media->original_name }}"
                            >
                                {{ $media->original_name }}
                            </div>
                            <div class="flex-grow"></div>
                            <div class="flex justify-between items-center text-sm mt-2">
                                <a
                                    href="{{ $viewRoute }}"
                                    target="_blank"
                                    class="inline-flex items-center px-3 py-2 rounded-md bg-blue-50 dark:bg-blue-900 text-blue-700 dark:text-blue-200 hover:bg-blue-100 dark:hover:bg-blue-800 transition shadow-sm"
                                >
                                    <i class="bi bi-eye mr-2"></i> {{ __('content.view') }}
                                </a>
                                <form method="POST" action="{{ route('media.destroy', $media) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="inline-flex items-center px-3 py-2 rounded-md bg-red-50 dark:bg-red-900 text-red-700 dark:text-red-200 hover:bg-red-100 dark:hover:bg-red-800 transition shadow-sm"
                                    >
                                        <i class="bi bi-trash mr-2"></i> {{ __('content.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 flex justify-center">
                {{ $userMedia->links('components.custom-pagination') }}
            </div>
        @else
            <p class="text-gray-600 dark:text-gray-400">
                {{ __('admin.no_user_media') }}
            </p>
        @endif

        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4 mt-8">
            {{ __('admin.user_links') }}
        </h3>
        @if ($userLinks->isNotEmpty())
            <div
                class="overflow-x-auto bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md mb-6"
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
                        @foreach ($userLinks as $link)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a
                                        href="{{ route('links.show', $link->slug) }}"
                                        target="_blank"
                                        class="text-dscpics-600 hover:underline dark:text-dscpics-400"
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
            <div class="mt-8 flex justify-center">
                {{ $userLinks->links('components.custom-pagination') }}
            </div>
        @else
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                {{ __('admin.no_user_links') }}
            </p>
        @endif


        <div class="mt-8 flex justify-between items-center">
            <a
                href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition shadow-sm"
            >
                <i class="bi bi-arrow-left mr-2"></i> {{ __('admin.back_to_dashboard') }}
            </a>
            @if (auth()->user()->id !== $user->id)
                <button
                    @click="showDeleteUserModal = true"
                    class="inline-flex items-center px-4 py-2 bg-red-600 dark:bg-red-700 text-white rounded-md hover:bg-red-700 dark:hover:bg-red-800 transition shadow-sm"
                >
                    <i class="bi bi-person-x mr-2"></i> {{ __('admin.delete_user') }}
                </button>
            @endif
        </div>

        <div
            x-show="showRoleModal"
            x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50 p-4"
            @click.away="showRoleModal = false"
        >
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-sm w-full p-8 transform transition-all sm:my-8 sm:align-middle sm:max-w-lg"
                x-data="{ modalEmailHover: false }"
            >
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                    {{ __('admin.change_user_role') }}
                </h3>
                <p class="mb-4 text-gray-600 dark:text-gray-300">
                    {{ $user->name }} (<span
                        class="transition-all duration-300 text-gray-800 dark:text-gray-200"
                        :class="{ 'filter blur-sm': !modalEmailHover }"
                        @mouseenter="modalEmailHover = true"
                        @mouseleave="modalEmailHover = false"
                    >{{ $user->email }}</span>)
                </p>

                <form method="POST" action="{{ route('admin.users.update_role', $user) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-6">
                        <label
                            for="new_role"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                        >
                            {{ __('admin.select_new_role') }}
                        </label>
                        <select
                            id="new_role"
                            name="role"
                            x-model="newRole"
                            class="block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm focus:border-dscpics-500 focus:ring focus:ring-dscpics-500 focus:ring-opacity-50 px-4 py-2"
                        >
                            <option value="user">{{ __('admin.role_user') }}</option>
                            <option value="admin">{{ __('admin.role_admin') }}</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button
                            @click="showRoleModal = false"
                            type="button"
                            class="px-5 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition shadow-sm"
                        >
                            {{ __('content.cancel') }}
                        </button>
                        <button
                            type="submit"
                            class="px-5 py-2 bg-dscpics-600 dark:bg-dscpics-700 text-white rounded-lg hover:bg-dscpics-700 dark:hover:bg-dscpics-800 transition shadow-sm"
                        >
                            {{ __('admin.save_changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div
            x-show="showDeleteUserModal"
            x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50 p-4"
            @click.away="showDeleteUserModal = false"
        >
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-sm w-full p-8 transform transition-all sm:my-8 sm:align-middle sm:max-w-lg"
                x-data="{ modalEmailHover: false }"
            >
                <h3 class="text-xl font-bold text-red-700 dark:text-red-500 mb-4">
                    {{ __('admin.confirm_delete_user') }}
                </h3>
                <p class="mb-6 text-gray-600 dark:text-gray-300">
                    {{ __('admin.delete_user_warning', ['user_name' => $user->name]) }} (<span
                        class="transition-all duration-300 text-gray-800 dark:text-gray-200"
                        :class="{ 'filter blur-sm': !modalEmailHover }"
                        @mouseenter="modalEmailHover = true"
                        @mouseleave="modalEmailHover = false"
                    >{{ $user->email }}</span>)
                </p>

                <div class="flex justify-end space-x-3">
                    <button
                        @click="showDeleteUserModal = false"
                        type="button"
                        class="px-5 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition shadow-sm"
                    >
                        {{ __('content.cancel') }}
                    </button>
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="px-5 py-2 bg-red-600 dark:bg-red-700 text-white rounded-lg hover:bg-red-700 dark:hover:bg-red-800 transition shadow-sm"
                        >
                            {{ __('admin.delete_user_confirm') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection