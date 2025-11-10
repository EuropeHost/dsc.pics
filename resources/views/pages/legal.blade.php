@extends('layouts.main')

@section('main')
    <style>
        /* Basic typography styles for legal content */
        .prose h1 {
            font-size: 2.25rem; /* 3xl */
            font-weight: 700; /* bold */
            margin-bottom: 1.5rem; /* mb-6 */
            color: #1a202c; /* gray-900 */
        }
        .dark .prose h1 {
            color: #f7fafc; /* gray-100 */
        }
        .prose h2 {
            font-size: 1.875rem; /* 2xl */
            font-weight: 700; /* bold */
            margin-top: 2.5rem; /* mt-10 */
            margin-bottom: 1rem; /* mb-4 */
            color: #1a202c; /* gray-900 */
        }
        .dark .prose h2 {
            color: #f7fafc; /* gray-100 */
        }
        .prose h3 {
            font-size: 1.5rem; /* xl */
            font-weight: 600; /* semibold */
            margin-top: 2rem; /* mt-8 */
            margin-bottom: 0.75rem; /* mb-3 */
            color: #1a202c; /* gray-900 */
        }
        .dark .prose h3 {
            color: #f7fafc; /* gray-100 */
        }
        .prose p {
            margin-bottom: 1rem; /* mb-4 */
            line-height: 1.625; /* leading-relaxed */
            color: #4a5568; /* gray-700 */
        }
        .dark .prose p {
            color: #cbd5e0; /* gray-300 */
        }
        .prose ul {
            list-style-type: disc;
            margin-left: 1.25rem; /* ml-5 */
            margin-bottom: 1rem; /* mb-4 */
            color: #4a5568; /* gray-700 */
        }
        .dark .prose ul {
            color: #cbd5e0; /* gray-300 */
        }
        .prose ol {
            list-style-type: decimal;
            margin-left: 1.25rem; /* ml-5 */
            margin-bottom: 1rem; /* mb-4 */
            color: #4a5568; /* gray-700 */
        }
        .dark .prose ol {
            color: #cbd5e0; /* gray-300 */
        }
        .prose li {
            margin-bottom: 0.5rem; /* mb-2 */
        }
        .prose a {
            color: #0ea5e9; /* sky-500 */
            text-decoration: underline;
        }
        .dark .prose a {
            color: #38bdf8; /* sky-400 */
        }
        .prose strong {
            font-weight: 700; /* bold */
        }
    </style>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ $title }}</h1>
        <div class="prose dark:prose-invert max-w-none">
            {!! $content !!}
        </div>

        {{-- Legal Sections Navigation --}}
        <div class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('legal.more_sections') }}</h2>
            <ul class="list-disc list-inside space-y-2">
                @foreach(config('app.legal_sections') as $section)
                    <li>
                        <a href="{{ route('pages.legal', $section) }}" class="text-dscpics-600 hover:underline dark:text-dscpics-400">
                            {{ __('legal.' . $section . '.title') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    {{-- IMPORTANT: If Tailwind Typography styles are not applying, ensure you have run `npm install -D @tailwindcss/typography` and `npm run dev` --}}
@endsection