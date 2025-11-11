<div class="fixed bottom-5 right-5 z-50 w-[450px] space-y-4">
    @if (session('success'))
        <div
            id="toast-success"
            class="flex w-full items-center rounded-lg border border-gray-200 bg-white p-4 pe-5 text-gray-700 shadow-lg dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 transition-all duration-300 ease-in-out transform hover:scale-105"
            role="alert"
            x-data="{ open: true }"
            x-show="open"
            x-init="setTimeout(() => { open = false }, 5000)"
            x-transition:enter="slide-in"
            x-transition:leave="slide-out"
        >
            <div
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-700 dark:text-green-200"
            >
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
                    />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
            <button
                type="button"
                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                @click="open = false"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
                <svg
                    class="h-3 w-3"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 14 14"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                    />
                </svg>
            </button>
        </div>
    @endif

    @if (session(key: 'error'))
        <div
            id="toast-danger"
            class="flex w-full items-center rounded-lg border border-gray-200 bg-white p-4 pe-5 text-gray-700 shadow-lg dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 transition-all duration-300 ease-in-out transform hover:scale-105"
            role="alert"
            x-data="{ open: true }"
            x-show="open"
            x-init="setTimeout(() => { open = false }, 10000)"
            x-transition:enter="slide-in"
            x-transition:leave="slide-out"
        >
            <div
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600 dark:bg-red-700 dark:text-red-200"
            >
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"
                    />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('error') }}</div>
            <button
                type="button"
                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                @click="open = false"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
                <svg
                    class="h-3 w-3"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 14 14"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                    />
                </svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div
            id="toast-danger"
            class="flex w-full items-center rounded-lg border border-gray-200 bg-white p-4 pe-5 text-gray-700 shadow-lg dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 transition-all duration-300 ease-in-out transform hover:scale-105"
            role="alert"
            x-data="{ open: true }"
            x-show="open"
            x-init="setTimeout(() => { open = false }, 10000)"
            x-transition:enter="slide-in"
            x-transition:leave="slide-out"
        >
            <div
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600 dark:bg-red-700 dark:text-red-200"
            >
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"
                    />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button
                type="button"
                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                @click="open = false"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
                <svg
                    class="h-3 w-3"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 14 14"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                    />
                </svg>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div
            id="toast-warning"
            class="flex w-full items-center rounded-lg border border-gray-200 bg-white p-4 pe-5 text-gray-700 shadow-lg dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 transition-all duration-300 ease-in-out transform hover:scale-105"
            role="alert"
            x-data="{ open: true }"
            x-show="open"
            x-init="setTimeout(() => { open = false }, 5000)"
            x-transition:enter="slide-in"
            x-transition:leave="slide-out"
        >
            <div
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-orange-600 dark:bg-orange-700 dark:text-orange-200"
            >
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"
                    />
                </svg>
                <span class="sr-only">Warning icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('warning') }}</div>
            <button
                type="button"
                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                @click="open = false"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
                <svg
                    class="h-3 w-3"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 14 14"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                    />
                </svg>
            </button>
        </div>
    @endif

    @if (session('info'))
        <div
            id="toast-info"
            class="flex w-full items-center rounded-lg border border-gray-200 bg-white p-4 pe-5 text-gray-700 shadow-lg dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 transition-all duration-300 ease-in-out transform hover:scale-105"
            role="alert"
            x-data="{ open: true }"
            x-show="open"
            x-init="setTimeout(() => { open = false }, 5000)"
            x-transition:enter="slide-in"
            x-transition:leave="slide-out"
        >
            <div
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-700 dark:text-blue-200"
            >
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"
                    />
                </svg>
                <span class="sr-only">Info icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('info') }}</div>
            <button
                type="button"
                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                @click="open = false"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
                <svg
                    class="h-3 w-3"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 14 14"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                    />
                </svg>
            </button>
        </div>
    @endif
</div>

<style>
    /* Add transition styles for Alpine.js */
    [x-transition:enter] {
        transition-property: transform, opacity;
        transition-duration: 300ms;
        transition-timing-function: ease-out;
    }

    [x-transition:leave] {
        transition-property: transform, opacity;
        transition-duration: 300ms;
        transition-timing-function: ease-in;
    }

    [x-transition:enter].slide-in {
        opacity: 0;
        transform: translateX(100%);
    }

    [x-transition:enter-start].slide-in {
        opacity: 0;
        transform: translateX(100%);
    }

    [x-transition:enter-end].slide-in {
        opacity: 1;
        transform: translateX(0);
    }

    [x-transition:leave].slide-out {
        opacity: 1;
        transform: translateX(0);
    }

    [x-transition:leave-start].slide-out {
        opacity: 1;
        transform: translateX(0);
    }

    [x-transition:leave-end].slide-out {
        opacity: 0;
        transform: translateX(100%);
    }
</style>