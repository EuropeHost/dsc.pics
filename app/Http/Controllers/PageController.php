<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\User;
use App\Models\Link;
use App\Models\LinkView;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function home()
    {
        $totalUsed = Media::sum('size');
        $totalUsers = User::count();
        $totalMedia = Media::count();
        $totalLinks = Link::count();
        $avgPerUser = $totalUsers > 0 ? $totalUsed / $totalUsers : 0;

        $totalLimit = env('STORAGE_LIMIT', 100) * 1024 * 1024 * 1024; // STORAGE_LIMIT GiB in bytes
        $storagePercentage = min(100, ($totalUsed / $totalLimit) * 100);

        // Stats for specific timeframes
        $last30Days = Carbon::now()->subDays(30);
        $last24Hours = Carbon::now()->subHours(24);

        $mediaLast30Days = Media::where('created_at', '>=', $last30Days)->count();
        $mediaLast24Hours = Media::where('created_at', '>=', $last24Hours)->count();

        $linkViewsLast30Days = LinkView::where('created_at', '>=', $last30Days)->count();
        $linkViewsLast24Hours = LinkView::where('created_at', '>=', $last24Hours)->count();


        // --- Top Users by Storage ---
        $topStorageUsers = User::withSum('media', 'size')
            ->orderByDesc('media_sum_size')
            ->take(3)
            ->get()
            ->map(function ($user) {
                $avatarUrl = asset('img/default-avatar.png');
                if ($user->discord_id && $user->avatar) {
                    $avatarUrl = "https://cdn.discordapp.com/avatars/{$user->discord_id}/{$user->avatar}.png";
                }
                return (object) [
                    'name' => $user->name,
                    'avatar_url' => $avatarUrl,
                    'storage_used_mb' => number_format($user->media_sum_size / 1048576, 2),
                ];
            });

        // --- Top Users by Media Count ---
        $topMediaUsers = User::withCount('media')
            ->orderByDesc('media_count')
            ->take(4)
            ->get()
            ->map(function ($user) {
                $avatarUrl = asset('img/default-avatar.png');
                if ($user->discord_id && $user->avatar) {
                    $avatarUrl = "https://cdn.discordapp.com/avatars/{$user->discord_id}/{$user->avatar}.png";
                }
                return (object) [
                    'name' => $user->name,
                    'avatar_url' => $avatarUrl,
                    'media_count' => $user->media_count,
                ];
            });

        // --- Top Users by Link Count ---
        $topLinkUsers = User::withCount('links')
            ->orderByDesc('links_count')
            ->take(2)
            ->get()
            ->map(function ($user) {
                $avatarUrl = asset('img/default-avatar.png');
                if ($user->discord_id && $user->avatar) {
                    $avatarUrl = "https://cdn.discordapp.com/avatars/{$user->discord_id}/{$user->avatar}.png";
                }
                return (object) [
                    'name' => $user->name,
                    'avatar_url' => $avatarUrl,
                    'link_count' => $user->links_count,
                ];
            });


        return view('pages.home', [
            'totalUsed' => $totalUsed,
            'totalUsers' => $totalUsers,
            'totalMedia' => $totalMedia,
            'totalLinks' => $totalLinks,
            'avgPerUser' => $avgPerUser,
            'totalLimit' => $totalLimit,
            'storagePercentage' => $storagePercentage,
            'topStorageUsers' => $topStorageUsers,
            'topMediaUsers' => $topMediaUsers,
            'topLinkUsers' => $topLinkUsers,
            'mediaLast30Days' => $mediaLast30Days,
            'mediaLast24Hours' => $mediaLast24Hours,
            'linkViewsLast30Days' => $linkViewsLast30Days,
            'linkViewsLast24Hours' => $linkViewsLast24Hours,
        ]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        $userLinksWithViewsCount = $user->links()->withCount('views')->get();

        $totalUserLinkViews = $userLinksWithViewsCount->sum('views_count');

        $latestMedia = $user->media()->latest()->take(3)->get();
        $latestLinks = $userLinksWithViewsCount->sortByDesc('created_at')->take(5);
        
        return view('pages.dashboard', compact(['latestMedia', 'latestLinks', 'totalUserLinkViews']));
    }

    public function legal(string $section)
    {
        $legal = __('legal.' . $section);

        abort_if(!is_array($legal) || !isset($legal['title'], $legal['content']), 404);

        return view('pages.legal', [
            'title' => $legal['title'],
            'content' => $legal['content'],
        ]);
    }
}
