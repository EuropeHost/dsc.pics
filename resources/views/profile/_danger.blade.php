<div class="bg-red-50 dark:bg-red-950 p-6 rounded-lg border border-red-200 dark:border-red-700">
    <p class="text-md text-red-700 dark:text-red-200 mb-4">
        {{ __('profile.delete_account_warning_intro') }}
    </p>

    <button
        @click="showDeleteModal = true"
        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800 transition shadow-sm"
    >
        <i class="bi bi-person-x mr-2"></i> {{ __('profile.delete_my_account') }}
    </button>

    <div
        x-show="showDeleteModal"
        x-cloak
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50 p-4"
        @click.away="showDeleteModal = false"
    >
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-sm w-full p-8 transform transition-all sm:my-8 sm:align-middle sm:max-w-lg"
        >
            <h3 class="text-xl font-bold text-red-700 dark:text-red-500 mb-4">
                {{ __('profile.confirm_account_deletion') }}
            </h3>
            <p class="mb-6 text-gray-600 dark:text-gray-300">
                {{ __('profile.delete_account_warning_detail') }}
            </p>

            <div class="flex justify-end space-x-3">
                <button
                    @click="showDeleteModal = false"
                    type="button"
                    class="px-5 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition shadow-sm"
                >
                    {{ __('content.cancel') }}
                </button>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="px-5 py-2 bg-red-600 dark:bg-red-700 text-white rounded-lg hover:bg-red-700 dark:hover:bg-red-800 transition shadow-sm"
                    >
                        {{ __('profile.delete_account_confirm') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>