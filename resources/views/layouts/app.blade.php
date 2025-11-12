<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        />
        <title>{{ config('app.name', 'dsc.pics') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        />
    </head>

    <body
        class="min-h-screen flex flex-col bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100"
    >
        <div id="preloader">
            <div class="spinner"></div>
        </div>

        @if(empty($hideNavbar))
            @include('components.navbar')
        @endif

        <main class="flex-grow">
            @yield('content')
        </main>

        @if(empty($hideFooter))
            @include('components.footer')
        @endif

        <script
            defer
            src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
        ></script>

        <script>
            window.addEventListener('load', () => {
                document.getElementById('preloader')?.classList.add('hidden');
                window.dispatchEvent(new Event('preloader:done'));
                window._preloaderDone = true;
            });
        </script>

        @stack('scripts')
    </body>
</html>