<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\V2\ApiController;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Validator;

class LinkController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $links = $request->user()->links()->withCount('views')->latest()->paginate(15);
        return $this->sendResponse($links, 'Links retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url',
            'slug' => 'nullable|string|unique:links,slug|alpha_dash|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors()->toArray(), 422);
        }

        $link = $request->user()->links()->create($validator->validated());

        return $this->sendResponse($link, 'Link created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Link $link)
    {
        if ($link->user_id !== $request->user()->id) {
            return $this->sendError('Unauthorized.', [], 403);
        }

        $link->loadCount('views');
        return $this->sendResponse($link, 'Link retrieved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Link $link)
    {
        if ($link->user_id !== $request->user()->id) {
            return $this->sendError('Unauthorized.', [], 403);
        }

        $link->delete();

        return $this->sendResponse([], 'Link deleted successfully.');
    }
}