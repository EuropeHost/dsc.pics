@extends('layouts.app')

@section('content')

    @include('pages.lander._hero')

    @include('pages.lander._stats', ['stats' => $stats])

    @include('pages.lander._features')

@endsection