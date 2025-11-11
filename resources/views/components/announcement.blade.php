@php
    $announcements = [
        [
            'id' => 'alpha',
            'type' => 'info',
            'title' => __('announcement.alpha.title'),
            'message' => __('announcement.alpha.message'),
            'link' => [
                'href' => 'https://github.com/EuropeHost/dcpics.eu',
                'text' => __('announcement.alpha.cta'),
            ],
        ],
        [
            'id' => 'storage',
            'type' => 'success',
            'title' => __('announcement.storage.title'),
            'message' => __('announcement.storage.message'),
            'link' => null,
        ],
        [
            'id' => 'feedback_request',
            'type' => 'success',
            'title' => __('announcement.feedback.title'),
            'message' => __('announcement.feedback.message'),
            'link' => [
                'href' => 'https://github.com/EuropeHost/dcpics.eu/discussions',
                'text' => __('announcement.feedback.cta'),
            ],
        ],
    ];
@endphp

@foreach ($announcements as $announcement)
    @if (!session()->has("announcement_dismissed_{$announcement['id']}"))
        <div
            x-data="{ open: true }"
            x-show="open"
            x-transition:enter="slide-in-down"
            x-transition:leave="slide-out-up"
            class="relative w-full text-sm px-4 py-3 flex items-center justify-center gap-2 font-medium shadow-md z-50 transition-all duration-500 ease-in-out
            @if ($announcement['type'] === 'info')
                bg-blue-100 dark:bg-blue-900 border-b border-blue-200 dark:border-blue-700 text-blue-800 dark:text-blue-100
            @elseif ($announcement['type'] === 'warning')
                bg-yellow-100 dark:bg-yellow-900 border-b border-yellow-200 dark:border-yellow-700 text-yellow-800 dark:text-yellow-100
            @elseif ($announcement['type'] === 'danger')
                bg-red-100 dark:bg-red-900 border-b border-red-200 dark:border-red-700 text-red-800 dark:text-red-100
            @elseif ($announcement['type'] === 'success')
                bg-green-100 dark:bg-green-900 border-b border-green-200 dark:border-green-700 text-green-800 dark:text-green-100
            @else
                bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200
            @endif"
        >
            @if (!empty($announcement['title']))
                <span class="font-semibold">{{ $announcement['title'] }}:</span>
            @endif
            <span>{{ $announcement['message'] }}</span>
            @if (!empty($announcement['link']))
                <a
                    href="{{ $announcement['link']['href'] }}"
                    target="_blank"
                    class="text-sky-600 dark:text-sky-400 underline hover:text-sky-800 dark:hover:text-sky-200 transition duration-150 ease-in-out ml-1"
                >
                    {{ $announcement['link']['text'] }}
                </a>
            @endif

            <form
                method="POST"
                action="{{ route('announcement.dismiss', $announcement['id']) }}"
                class="absolute right-4 top-1/2 -translate-y-1/2"
            >
                @csrf
                <button
                    type="submit"
                    @click="open = false"
                    class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition text-lg leading-none"
                    aria-label="{{ __('Close announcement') }}"
                >
                    &times;
                </button>
            </form>
        </div>
    @endif
@endforeach

<style>
    [x-transition:enter].slide-in-down {
        opacity: 0;
        transform: translateY(-100%);
    }

    [x-transition:enter-start].slide-in-down {
        opacity: 0;
        transform: translateY(-100%);
    }

    [x-transition:enter-end].slide-in-down {
        opacity: 1;
        transform: translateY(0);
    }

    [x-transition:leave].slide-out-up {
        opacity: 1;
        transform: translateY(0);
    }

    [x-transition:leave-start].slide-out-up {
        opacity: 1;
        transform: translateY(0);
    }

    [x-transition:leave-end].slide-out-up {
        opacity: 0;
        transform: translateY(-100%);
    }
</style>