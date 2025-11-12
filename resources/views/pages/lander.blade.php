@extends('layouts.app')

@section('content')
    @php
        $glassyNavbar = true;
        $stickyNavbar = true;
        $floatingNavbar = true;
    @endphp
    @include('pages.lander._hero')

    @include('pages.lander._stats', ['stats' => $stats])

    @include('pages.lander._features')

    @include('pages.lander._faq')

@endsection