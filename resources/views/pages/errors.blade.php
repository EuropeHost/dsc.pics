@extends('layouts.app', ['hideNavbar' => true, 'hideFooter' => true])

@section('content')
	<div
		class="relative min-h-screen flex flex-col items-center justify-center p-4 dark:bg-gray-900 dark:text-gray-100"
	>
		<div class="absolute top-4 right-4 z-20">
            @include('components.theme-toggle')
		</div>

		<div
			class="relative z-10 text-center flex flex-col items-center justify-center"
		>
			<h2 class="text-4xl font-semibold text-dscpics-500 mb-2">
				{{ __(
				    'pages.errors.' . $exception->getStatusCode() . '.title',
				    ['status' => $exception->getStatusCode()],
				) }}
			</h2>
			<p class="text-xl text-gray-700 dark:text-gray-300 mb-8">
				{{ __(
				    'pages.errors.' . $exception->getStatusCode() . '.subtitle',
				    ['status' => $exception->getStatusCode()],
				) }}
			</p>

			<a
				href="{{ url('/') }}"
				class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-dscpics-600 hover:bg-dscpics-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dscpics-500"
			>
				{{ __('pages.errors.go_home') }}
			</a>
		</div>

		<h1
			class="absolute inset-0 flex items-center justify-center text-[22rem] font-extrabold text-dscpics-600 opacity-10 dark:text-dscpics-400"
			style="line-height: 1"
		>
			{{ $exception->getStatusCode() }}
		</h1>

		<div
			class="absolute bottom-0 w-full p-4 flex flex-col items-center justify-center text-sm text-gray-500 dark:text-gray-400"
		>
			<div
				class="pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-center text-sm text-gray-500 dark:text-gray-400"
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
			<p class="mt-4">
				&copy; {{ date('Y') }} {{ config('app.name') }}. All rights
				reserved.
			</p>
		</div>
	</div>
@endsection