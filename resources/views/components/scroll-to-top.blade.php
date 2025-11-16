<div x-data="{ scrolledToTop: true }"
    x-on:scroll.window="scrolledToTop = (window.pageYOffset || document.documentElement.scrollTop) === 0"
    x-show="!scrolledToTop" x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    class="fixed bottom-4 right-4 z-49 flex items-center justify-center space-x-2">
    <button x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="inline-flex items-center rounded-lg bg-dscpics-500 p-3 text-white shadow-lg transition-colors duration-300 hover:bg-dscpics-600 focus:outline-none focus:ring-2 focus:ring-dscpics-500 focus:ring-offset-2 dark:bg-dscpics-700 dark:hover:bg-dscpics-600 dark:focus:ring-dscpics-700 dark:focus:ring-offset-dscpics-900">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
            stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
        </svg>
    </button>
</div>