<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        />
        <title>{{ config('app.name', 'dcpic.eu') }}</title>

        <!-- TailwindCSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Bootstrap Icons -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        />

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/discord-login-btn.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/preloader.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/scroll-down-btn.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/feature-card.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/stats.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/animations.css') }}" />

    </head>

    <body class="min-h-screen flex flex-col bg-gray-100 text-gray-900">
        <div id="preloader"><div class="spinner"></div></div>

        @include('components.announcement')
        @include('components.navbar')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('components.footer')

        <script
            defer
            src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
        ></script>

        <script>
            window.addEventListener('load', () => {
                document.getElementById('preloader')?.classList.add('hidden');
                // Dispatch custom event after preloader is hidden
                window.dispatchEvent(new Event('preloader:done'));
                window._preloaderDone = true; // Set a flag if needed elsewhere
            });
        </script>

        @stack('scripts')
    </body>
</html>
