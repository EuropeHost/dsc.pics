<section
    id="leaderboards"
    class="home mx-auto flex w-full max-w-7xl flex-col
           items-center justify-center px-4 pb-12"
>
    {{-- Top Storage Users --}}
    @include('components.home_stat_users_container', [
        'container_title' => __('content.top_storage_users'),
        'users_collection' => $topStorageUsers,
        'count_field' => 'storage_used_mb',
        'count_label' => 'MB',
        'decimals' => 2,
        'col_span_lg' => 'lg:col-span-1',
        // 'grid_cols_lg' will be handled dynamically inside the component
    ])

    {{-- Top Media Users --}}
    @include('components.home_stat_users_container', [
        'container_title' => __('content.top_media_users'),
        // 'no_users_message' removed as it's not needed and will use default
        'users_collection' => $topMediaUsers,
        'count_field' => 'media_count',
        'count_label' => __('content.media'),
        'decimals' => 0,
        'col_span_lg' => 'lg:col-span-full',
        // 'grid_cols_lg' will be handled dynamically inside the component
    ])

    {{-- Top Link Users --}}
    @include('components.home_stat_users_container', [
        'container_title' => __('content.top_link_users'),
        // 'no_users_message' removed
        'users_collection' => $topLinkUsers,
        'count_field' => 'link_count',
        'count_label' => __('content.links'),
        'decimals' => 0,
        'col_span_lg' => 'lg:col-span-full',
        // 'grid_cols_lg' will be handled dynamically inside the component
    ])
</section>
