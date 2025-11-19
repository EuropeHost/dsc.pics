<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\V2\ApiController;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Link;

class UserController extends ApiController
{
    public function stats(Request $request)
    {
        $user = $request->user();

        $mediaCount = $user->media()->count();
        $storageUsedBytes = $user->media()->sum('size');
        $linksCount = $user->links()->count();
        $linkViewsCount = $user->links()->withCount('views')->get()->sum('views_count');

        $stats = [
            'media_count' => $mediaCount,
            'storage_used_bytes' => $storageUsedBytes,
            'links_count' => $linksCount,
            'link_views_count' => $linkViewsCount,
        ];

        return $this->sendResponse($stats, 'User statistics retrieved successfully.');
    }
}