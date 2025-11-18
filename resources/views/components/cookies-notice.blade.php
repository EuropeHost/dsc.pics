<div
    id="cookies-notice"
    x-data="{ show: false }"
    x-show="show"
    x-transition:enter="slide-in"
    x-transition:leave="slide-out"
    class="fixed bottom-5 left-5 z-[100] hidden w-full max-w-sm rounded-lg border border-gray-200 bg-white p-4 shadow-lg dark:border-gray-700 dark:bg-gray-800"
    role="dialog"
    aria-modal="true"
    aria-labelledby="cookies-notice-title"
    aria-describedby="cookies-notice-description"
>
    <div class="flex items-start">
        <div class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-700 dark:text-blue-200">
            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
            </svg>
            <span class="sr-only">Info icon</span>
        </div>
        <div class="ms-3 text-sm font-normal text-gray-700 dark:text-gray-300">
            <p id="cookies-notice-description" class="mb-4">
                {{ __('pages.legal.cookies-notice.content') }}
            </p>
            <div class="flex flex-col space-y-2 sm:flex-row sm:space-x-2 sm:space-y-0">
                <button
                    id="accept-cookies"
                    class="inline-flex flex-1 items-center justify-center rounded-lg border border-transparent bg-dscpics-600 px-3 py-2 text-center text-xs font-medium text-white shadow-sm transition-all duration-200 hover:bg-dscpics-700 focus:outline-none focus:ring-4 focus:ring-dscpics-300 dark:bg-dscpics-500 dark:hover:bg-dscpics-600 dark:focus:ring-dscpics-800"
                >
                    {{ __('content.accept') }}
                </button>
                <!--button
                    id="decline-cookies"
                    class="inline-flex flex-1 items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-center text-xs font-medium text-gray-900 shadow-sm transition-all duration-200 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                -->
                <button
                    id="accept-cookies"
                    class="inline-flex flex-1 items-center justify-center rounded-lg border border-transparent bg-dscpics-600 px-3 py-2 text-center text-xs font-medium text-white shadow-sm transition-all duration-200 hover:bg-dscpics-700 focus:outline-none focus:ring-4 focus:ring-dscpics-300 dark:bg-dscpics-500 dark:hover:bg-dscpics-600 dark:focus:ring-dscpics-800"
                >
                    {{ __('content.decline') }}
                </button>
            </div>
        </div>
        <button
            type="button"
            id="close-cookies-notice"
            @click="show = false"
            class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-16 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
            aria-label="Close"
        >
            <span class="sr-only">Close</span>
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('cookieNotice', () => ({
        show: false,
        init() {
            if (localStorage.getItem('cookies_settings') === null) {
                this.show = true;
            }

            document.getElementById('accept-cookies').addEventListener('click', () => {
                localStorage.setItem('cookies_settings', 'accepted');
                this.show = false;
            });

            document.getElementById('decline-cookies').addEventListener('click', () => {
                localStorage.setItem('cookies_settings', 'declined');
                this.show = false;
            });
        },
        openNotice() {
            this.show = true;
        }
    }));
});

window.showCookieNotice = function() {
    const cookiesNoticeElement = document.getElementById('cookies-notice');
    if (cookiesNoticeElement && cookiesNoticeElement.__alpine) {
        cookiesNoticeElement.__alpine.$data.openNotice();
    } else {
        if (cookiesNoticeElement) {
            cookiesNoticeElement.style.display = 'block';
        }
    }
};
</script>