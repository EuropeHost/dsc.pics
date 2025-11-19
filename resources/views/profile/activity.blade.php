@extends('layouts.main')

@section('main')
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h1 class="text-4xl font-extrabold text-gray-800 dark:text-gray-100 mb-4 md:mb-0">
                {{ __('activity.my_activity') }}
            </h1>
            <a href="{{ route('profile.show') }}" class="px-6 py-3 bg-dscpics-500 hover:bg-dscpics-600 text-white font-semibold rounded-xl shadow-md transition duration-200 ease-in-out">
                &larr; {{ __('activity.back_to_profile') }}
            </a>
        </div>

        <div class="overflow-x-auto -mx-8 sm:-mx-0">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('activity.description') }}
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('activity.subject') }}
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('activity.timestamp') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($activities as $activity)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $activity->subject ? __('activity.actions.' . $activity->description, ['model' => class_basename($activity->subject_type)]) : __('activity.actions.' . $activity->description) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                @if ($activity->subject)
                                    @php
                                        $route = null;
                                        if ($activity->subject_type === \App\Models\Media::class) {
                                            $route = route('media.show', $activity->subject);
                                        } elseif ($activity->subject_type === \App\Models\Link::class) {
                                            $route = route('links.show', $activity->subject);
                                        } elseif ($activity->subject_type === \App\Models\User::class && Auth::user()->isAdmin()) {
                                            $route = route('admin.users.show', $activity->subject);
                                        }
                                    @endphp
                                    @if ($route)
                                        <a href="{{ $route }}" class="text-dscpics-500 hover:text-dscpics-600 dark:text-dscpics-400 dark:hover:text-dscpics-500 font-medium">
                                            {{ $activity->subject->name ?? $activity->subject->title ?? $activity->subject->id }}
                                        </a>
                                    @else
                                        {{ $activity->subject->name ?? $activity->subject->title ?? $activity->subject->id }}
                                    @endif
                                @else
                                    <span class="text-gray-400 dark:text-gray-500">{{ __('activity.not_available') }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                <span title="{{ $activity->created_at->format('F j, Y, g:i A T') }}">
                                    {{ $activity->created_at->diffForHumans() }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 whitespace-nowrap text-base text-center text-gray-500 dark:text-gray-400">
                                {{ __('activity.no_activity') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg flex justify-center">
            {{ $activities->links('pagination::tailwind') }}
        </div>
    </div>
@endsection