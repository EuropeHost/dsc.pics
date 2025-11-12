@extends('layouts.main')

@section('main')
    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">
        {{ __('admin.admin_dashboard') }}
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                {{ __('admin.total_users') }}
            </p>
            <p class="text-4xl font-bold text-dscpics-600 dark:text-dscpics-400 mt-2">
                {{ number_format($totalUsers) }}
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                {{ __('admin.total_media') }}
            </p>
            <p class="text-4xl font-bold text-dscpics-600 dark:text-dscpics-400 mt-2">
                {{ number_format($totalMedia) }}
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                {{ __('admin.total_links') }}
            </p>
            <p class="text-4xl font-bold text-dscpics-600 dark:text-dscpics-400 mt-2">
                {{ number_format($totalLinks) }}
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                {{ __('admin.total_storage_used') }}
            </p>
            <p class="text-4xl font-bold text-dscpics-600 dark:text-dscpics-400 mt-2">
                {{ number_format($totalStorageUsedMB, 2) }} MB
            </p>
            <!--div class="w-full bg-gray-200 rounded-full h-3 mt-4">
                <div class="bg-dscpics-600 h-3 rounded-full" style="width: {{ number_format($systemStoragePercentage, 1) }}%"></div>
            </div>
            <p class="text-sm text-gray-600 mt-1">{{ number_format($systemStoragePercentage, 1) }}% {{ __('admin.of_total_limit') }}</p-->
        </div>
    </div>

    <div
        class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6"
        x-data="{
            search: '',
            roleFilter: 'all',
            sortBy: 'created_at',
            sortDirection: 'desc',
            filteredUsers: [],
            users: {{ Js::from($users->items()) }},
            init() {
                this.applyFilters();
                this.$watch('users', () => this.applyFilters());
            },
            applyFilters() {
                let sorted = [...this.users];

                sorted.sort((a, b) => {
                    let aValue = a[this.sortBy];
                    let bValue = b[this.sortBy];

                    if (['media_count', 'media_sum_size', 'links_count'].includes(this.sortBy)) {
                        aValue = parseFloat(aValue || 0);
                        bValue = parseFloat(bValue || 0);
                    }

                    if (this.sortDirection === 'asc') {
                        return aValue > bValue ? 1 : -1;
                    } else {
                        return aValue < bValue ? 1 : -1;
                    }
                });

                this.filteredUsers = sorted.filter(user => {
                    let matchSearch = true;
                    if (this.search) {
                        const searchTerm = this.search.toLowerCase();
                        matchSearch = user.name.toLowerCase().includes(searchTerm) ||
                            user.email.toLowerCase().includes(searchTerm) ||
                            (user.discord_id ? user.discord_id.toLowerCase().includes(searchTerm) : false);
                    }

                    let matchRole = true;
                    if (this.roleFilter !== 'all') {
                        matchRole = user.role === this.roleFilter;
                    }

                    return matchSearch && matchRole;
                });
            },
            formatBytes(bytes) {
                if (bytes === null || bytes === 0) return '0 MB';
                const megabytes = bytes / (1024 * 1024);
                return megabytes.toFixed(2) + ' MB';
            }
        }"
    >
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">
            {{ __('admin.user_management') }}
        </h2>

        <div
            class="flex flex-col md:flex-row md:justify-between mb-4 space-y-3 md:space-y-0 md:space-x-4"
        >
            <input
                type="text"
                x-model="search"
                @input="applyFilters"
                placeholder="{{ __('admin.search_users') }}"
                class="flex-grow border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm focus:border-dscpics-500 focus:ring focus:ring-dscpics-500 focus:ring-opacity-50 px-4 py-2"
            />

            <select
                x-model="roleFilter"
                @change="applyFilters"
                class="border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm focus:border-dscpics-500 focus:ring focus:ring-dscpics-500 focus:ring-opacity-50 px-4 py-2"
            >
                <option value="all">{{ __('admin.filter_by_role_all') }}</option>
                <option value="user">{{ __('admin.role_user') }}</option>
                <option value="admin">{{ __('admin.role_admin') }}</option>
            </select>

            <select
                x-model="sortBy"
                @change="applyFilters"
                class="border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm focus:border-dscpics-500 focus:ring focus:ring-dscpics-500 focus:ring-opacity-50 px-4 py-2"
            >
                <option value="created_at">{{ __('admin.sort_by_created') }}</option>
                <option value="name">{{ __('admin.sort_by_name') }}</option>
                <option value="media_count">{{ __('admin.sort_by_media') }}</option>
                <option value="media_sum_size">{{ __('admin.sort_by_storage') }}</option>
                <option value="links_count">{{ __('admin.sort_by_links') }}</option>
            </select>

            <button
                @click="sortDirection = sortDirection === 'asc' ? 'desc' : 'asc'; applyFilters()"
                class="border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 focus:border-dscpics-500 focus:ring focus:ring-dscpics-500 focus:ring-opacity-50 px-4 py-2 transition"
            >
                <i
                    :class="sortDirection === 'asc' ? 'bi bi-sort-numeric-down' : 'bi bi-sort-numeric-up'"
                ></i>
            </button>
        </div>

        <div
            class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm"
        >
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                        >
                            {{ __('admin.user') }}
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                        >
                            {{ __('admin.role') }}
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                        >
                            {{ __('admin.media_uploaded') }}
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                        >
                            {{ __('admin.storage_used') }}
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                        >
                            {{ __('admin.links_shortened') }}
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                        >
                            {{ __('admin.account_created_on') }}
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                        >
                            {{ __('admin.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <template x-for="user in filteredUsers" :key="user.id">
                        <tr x-data="{ emailHover: false }">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a
                                    :href="'{{ route('admin.users.show', ':userId') }}'.replace(':userId', user.id)"
                                    class="flex items-center group"
                                >
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img
                                            class="h-10 w-10 rounded-full object-cover group-hover:ring-2 group-hover:ring-dscpics-500 transition"
                                            :src="user.avatar_url || '{{ asset('img/default-avatar.png') }}'"
                                            :alt="user.name"
                                        />
                                    </div>
                                    <div class="ml-4">
                                        <div
                                            class="text-sm font-medium text-gray-900 dark:text-gray-100 group-hover:text-dscpics-600 dark:group-hover:text-dscpics-400 transition"
                                            x-text="user.name"
                                        ></div>
                                        <div
                                            class="text-sm text-gray-500 dark:text-gray-400 transition-all duration-300"
                                            :class="{ 'filter blur-sm': !emailHover }"
                                            @mouseenter="emailHover = true"
                                            @mouseleave="emailHover = false"
                                            x-text="user.email"
                                        ></div>
                                    </div>
                                </a>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                x-text="user.role"
                            ></td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                x-text="user.media_count"
                            ></td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                x-text="formatBytes(user.media_sum_size)"
                            ></td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                x-text="user.links_count"
                            ></td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"
                                x-text="new Date(user.created_at).toLocaleDateString()"
                            ></td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                            >
                                <a
                                    :href="'{{ route('admin.users.show', ':userId') }}'.replace(':userId', user.id)"
                                    class="text-dscpics-600 hover:text-dscpics-900 dark:text-dscpics-400 dark:hover:text-dscpics-200"
                                >
                                    {{ __('admin.view_details') }}
                                </a>
                            </td>
                        </tr>
                    </template>
                    <template x-if="filteredUsers.length === 0">
                        <tr>
                            <td
                                colspan="7"
                                class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400"
                            >
                                {{ __('admin.no_users_found') }}
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection