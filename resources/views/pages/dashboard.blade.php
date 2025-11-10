@extends('layouts.main')

@section('main')

    @include('pages.partials.storage-use')
    @include('pages.partials.media-upload')
    @include('pages.partials.link-shorten')
    @include('pages.partials.latest-media')
    @include('pages.partials.latest-links')
    @include('pages.partials.user-stats')

    @push('scripts')
        <script>
            // File input name display
            document.getElementById('fileInput').addEventListener('change', function() {
                const fileNameSpan = document.getElementById('fileName');
                if (this.files && this.files.length > 0) {
                    fileNameSpan.textContent = this.files[0].name;
                } else {
                    fileNameSpan.textContent = '{{ __('content.choose_file') }}';
                }
            });
        </script>
    @endpush
@endsection
