@extends('layouts.main')

@section('main')
    <style>
        .prose h1 {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #1a202c;
        }

        .dark .prose h1 {
            color: #f7fafc;
        }

        .prose h2 {
            font-size: 1.875rem;
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: #1a202c;
        }

        .dark .prose h2 {
            color: #f7fafc;
        }

        .prose h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            color: #1a202c;
        }

        .dark .prose h3 {
            color: #f7fafc;
        }

        .prose p {
            margin-bottom: 1rem;
            line-height: 1.625;
            color: #4a5568;
        }

        .dark .prose p {
            color: #cbd5e0;
        }

        .prose ul {
            list-style-type: disc;
            margin-left: 1.25rem;
            margin-bottom: 1rem;
            color: #4a5568;
        }

        .dark .prose ul {
            color: #cbd5e0;
        }

        .prose ol {
            list-style-type: decimal;
            margin-left: 1.25rem;
            margin-bottom: 1rem;
            color: #4a5568;
        }

        .dark .prose ol {
            color: #cbd5e0;
        }

        .prose li {
            margin-bottom: 0.5rem;
        }

        .prose a {
            color: #0ea5e9;
            text-decoration: underline;
        }

        .dark .prose a {
            color: #38bdf8;
        }

        .prose strong {
            font-weight: 700;
        }
    </style>
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