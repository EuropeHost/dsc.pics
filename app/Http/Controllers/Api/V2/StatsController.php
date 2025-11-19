<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\V2\ApiController;
use App\Models\User;
use App\Models\Media;
use App\Models\Link;
use App\Models\LinkView;
use App\Models\MediaView;
use Illuminate\Support\Facades\DB;

class StatsController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = [
            'users' => [
                'total' => User::count(),
            ],
            'media' => [
                'total' => Media::count(),
                'total_views' => MediaView::count(),
                'storage_used_bytes' => Media::sum('size'),
            ],
            'links' => [
                'total' => Link::count(),
                'total_views' => LinkView::count(),
            ],
        ];

        return $this->sendResponse($stats, 'Statistics retrieved successfully.');
    }

    public function users()
    {
        $usersByDay = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        return $this->sendResponse(['by_day' => $usersByDay], 'User statistics retrieved successfully.');
    }

    public function media()
    {
        $mediaByDay = Media::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $mediaByType = Media::select('type', DB::raw('count(*) as count'))->groupBy('type')->get();
        $mediaByVisibility = Media::select('is_public', DB::raw('count(*) as count'))->groupBy('is_public')->get()->mapWithKeys(function ($item) {
            return [(bool)$item['is_public'] ? 'public' : 'private' => $item['count']];
        });


        return $this->sendResponse([
            'by_day' => $mediaByDay,
            'by_type' => $mediaByType,
            'by_visibility' => $mediaByVisibility,
        ], 'Media statistics retrieved successfully.');
    }

    public function links()
    {
        $linksByDay = Link::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $linkViewsByDay = LinkView::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        return $this->sendResponse([
            'creation_by_day' => $linksByDay,
            'views_by_day' => $linkViewsByDay,
        ], 'Link statistics retrieved successfully.');
    }
}