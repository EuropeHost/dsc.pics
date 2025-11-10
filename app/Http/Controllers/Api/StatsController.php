<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Media;
use App\Models\Link;
use App\Models\LinkView;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    /**
     * Get global platform statistics.
     * Accessible publicly.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function globalStats()
    {
        $totalUsed = Media::sum('size');
        $totalUsers = User::count();
        $totalMedia = Media::count();
        $totalLinks = Link::count();
        $avgPerUser = $totalUsers > 0 ? $totalUsed / $totalUsers : 0;

        $totalLimit = env('STORAGE_LIMIT', 100) * 1024 * 1024 * 1024;
        $storagePercentage = ($totalLimit > 0) ? ($totalUsed / $totalLimit) * 100 : 0;
        $storagePercentage = min(100, $storagePercentage);

        $last30Days = Carbon::now()->subDays(30);
        $last24Hours = Carbon::now()->subHours(24);

        $mediaLast30Days = Media::where('created_at', '>=', $last30Days)->count();
        $mediaLast24Hours = Media::where('created_at', '>=', $last24Hours)->count();

        $linkViewsLast30Days = LinkView::where('created_at', '>=', $last30Days)->count();
        $linkViewsLast24Hours = LinkView::where('created_at', '>=', '>=', $last24Hours)->count();

        return response()->json([
            'global' => [
                'total_users' => $totalUsers,
                'total_media' => $totalMedia,
                'total_links' => $totalLinks,
                'total_storage_used_mb' => round($totalUsed / 1024 / 1024, 2),
                'total_storage_limit_gib' => round($totalLimit / 1024 / 1024 / 1024, 2),
                'storage_percentage' => round($storagePercentage, 1),
                'average_storage_per_user_mb' => round($avgPerUser / 1024 / 1024, 2),
                'last_30_days' => [
                    'media' => $mediaLast30Days,
                    'link_views' => $linkViewsLast30Days,
                ],
                'last_24_hours' => [
                    'media' => $mediaLast24Hours,
                    'link_views' => $linkViewsLast24Hours,
                ],
            ]
        ]);
    }
}
