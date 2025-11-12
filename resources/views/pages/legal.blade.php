@extends('layouts.main')

@section('main')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">
            {{ $title }}
        </h1>
        <div class="prose dark:prose-invert max-w-none">
            {!! $content !!}
        </div>

        <div
            class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-center text-sm text-gray-500 dark:text-gray-400"
        >
            @foreach (config('app.legal_sections') as $index => $section)
                <a
                    href="{{ route('pages.legal', $section) }}"
                    class="text-dscpics-600 hover:underline dark:text-dscpics-400"
                >
                    {{ __('legal.' . $section . '.title') }}
                </a>
                @unless ($loop->last)
                    <span class="mx-2">&bull;</span>
                @endunless
            @endforeach
        </div>
    </div>
@endsection