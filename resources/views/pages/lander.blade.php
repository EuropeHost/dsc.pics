@extends('layouts.app')

@section('content')

    @include('pages.lander._hero')

    @push('scripts')
        <script>
            window.addEventListener('preloader:done', () => {
                stars();
                document.addEventListener('pointermove', tilt, {
                    passive: true
                });
                setupStatAnimations();
            });

            window.addEventListener('load', () => {
                setTimeout(() => {
                    if (!window._preloaderDone) {
                        window.dispatchEvent(new Event('preloader:done'));
                        window._preloaderDone = true;
                    }
                }, 1500);
            });
        </script>
    @endpush
@endsection
