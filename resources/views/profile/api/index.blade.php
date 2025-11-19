@extends('layouts.main')

@section('main')
<div x-data="{
    showCreateModal: false,
    showDeleteModal: false,
    deleteTokenUrl: '',
    showNewTokenModal: {{ session()->has('new-token') ? 'true' : 'false' }}
}">
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h1 class="text-4xl font-extrabold text-gray-800 dark:text-gray-100 mb-4 md:mb-0">
                {{ __('api.token_management') }}
            </h1>
            <button @click="showCreateModal = true" class="px-6 py-3 bg-dscpics-500 hover:bg-dscpics-600 text-white font-semibold rounded-xl shadow-md transition duration-200 ease-in-out">
                {{ __('api.create_token') }}
            </button>
        </div>

        @if ($tokens->isEmpty())
            <div class="text-center py-10">
                <p class="text-lg text-gray-500 dark:text-gray-400">
                    {{ __('api.no_tokens') }}
                </p>
                <p class="mt-2 text-gray-400 dark:text-gray-500">
                    {{ __('api.get_started_create_token') }}
                </p>
            </div>
        @else
            <div class="overflow-x-auto -mx-8 sm:-mx-0">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('api.token_name') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('api.permissions') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('api.last_used') }}
                            </th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">{{ __('api.actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($tokens as $token)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-gray-900 dark:text-gray-100">
                                    {{ $token->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                    @if (empty($token->abilities))
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                            * (all)
                                        </span>
                                    @else
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($token->abilities as $ability)
                                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                    {{ $ability }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                    {{ $token->last_used_at ? $token->last_used_at->diffForHumans() : __('api.never') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('profile.api-tokens.activity', $token) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600 mr-3">{{ __('activity.activity_log') }}</a>
                                    <button @click="showDeleteModal = true; deleteTokenUrl = '{{ route('profile.api-tokens.destroy', $token) }}'" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">{{ __('api.delete') }}</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Create Token Modal -->
    <div x-show="showCreateModal" x-cloak class="fixed z-50 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
                <form action="{{ route('profile.api-tokens.store') }}" method="POST">
                    @csrf
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 dark:bg-dscpics-950 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-blue-600 dark:text-dscpics-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2v5a2 2 0 01-2 2h-5a2 2 0 01-2-2V9a2 2 0 012-2h5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9m0 0l-2-2m2 2l2-2m-2 2l-2 2" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-2xl leading-6 font-bold text-gray-900 dark:text-gray-100" id="modal-title">
                                    {{ __('api.create_token') }}
                                </h3>
                                <div class="mt-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ __('api.token_name') }}
                                    </label>
                                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm focus:ring-dscpics-500 focus:border-dscpics-500 sm:text-sm" required>
                                </div>
                                <div class="mt-6">
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">
                                        {{ __('api.permissions') }}
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                                        @foreach ($permissions as $ability => $label)
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="{{ $ability }}" name="abilities[]" type="checkbox" value="{{ $ability }}" class="focus:ring-dscpics-500 h-5 w-5 text-dscpics-600 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded transition duration-150 ease-in-out">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="{{ $ability }}" class="font-medium text-gray-700 dark:text-gray-300 cursor-pointer">
                                                        {{ $label }}
                                                    </label>
                                                    <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">
                                                        {{ $descriptions[$ability] }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-3 bg-dscpics-600 text-base font-semibold text-white hover:bg-dscpics-700 sm:ml-3 sm:w-auto sm:text-sm transition duration-150 ease-in-out">
                            {{ __('api.create') }}
                        </button>
                        <button @click="showCreateModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-3 bg-white dark:bg-gray-700 text-base font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-150 ease-in-out">
                            {{ __('api.cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- New Token Modal -->
    @if (session()->has('new-token'))
    <div x-show="showNewTokenModal" x-cloak class="fixed z-50 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-950 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600 dark:text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-2xl leading-6 font-bold text-gray-900 dark:text-gray-100" id="modal-title">
                                {{ session('token-name') }} {{ __('api.token_created') }}
                            </h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('api.new_token_message') }}
                            </p>
                            <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-900 rounded-lg border border-dashed border-gray-300 dark:border-gray-700">
                                <code class="text-sm font-mono text-gray-800 dark:text-gray-200 break-all select-all">
                                    {{ session('new-token') }}
                                </code>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
                    <button @click="showNewTokenModal = false" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-3 bg-dscpics-600 text-base font-semibold text-white hover:bg-dscpics-700 sm:ml-3 sm:w-auto sm:text-sm transition duration-150 ease-in-out">
                        {{ __('api.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Delete Token Modal -->
    <div x-show="showDeleteModal" x-cloak class="fixed z-50 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form :action="deleteTokenUrl" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-950 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600 dark:text-red-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-2xl leading-6 font-bold text-gray-900 dark:text-gray-100" id="modal-title">
                                    {{ __('api.delete') }} {{ __('api.token') }}
                                </h3>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('api.confirm_delete') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-3 bg-red-600 text-base font-semibold text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm transition duration-150 ease-in-out">
                            {{ __('api.delete') }}
                        </button>
                        <button @click="showDeleteModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-3 bg-white dark:bg-gray-700 text-base font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-150 ease-in-out">
                            {{ __('api.cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection