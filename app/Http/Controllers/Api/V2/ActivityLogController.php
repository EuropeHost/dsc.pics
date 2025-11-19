<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\V2\ApiController;
use Illuminate\Http\Request;

class ActivityLogController extends ApiController
{
    public function index(Request $request)
    {
        $activities = $request->user()->actions()->latest()->paginate(15);

        return $this->sendResponse($activities, 'Activity logs retrieved successfully.');
    }
}