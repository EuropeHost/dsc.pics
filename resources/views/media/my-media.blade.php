@extends('layouts.main')

@section('main')
    <h1 class="text-2xl font-semibold mb-6">{{ __('content.my_media') }}</h1>

    @include('media._list', ['mediaItems' => $mediaItems])
@endsection
