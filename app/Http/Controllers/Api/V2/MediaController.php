<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\V2\ApiController;
use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MediaController extends ApiController
{
    public function index(Request $request)
    {
        $media = $request->user()->media()->latest()->paginate(15);

        return $this->sendResponse($media, 'Media retrieved successfully.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,webm,mov|max:20480', // 20MB Max
            'is_public' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors()->toArray(), 422);
        }

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $mime = $file->getMimeType();
        $size = $file->getSize();

        Storage::disk('public')->put($filename, file_get_contents($file));

        $media = $request->user()->media()->create([
            'filename' => $filename,
            'original_name' => $originalName,
            'mime' => $mime,
            'size' => $size,
            'is_public' => $request->input('is_public', false),
            'type' => Str::startsWith($mime, 'video') ? 'video' : 'image',
        ]);

        return $this->sendResponse($media, 'Media uploaded successfully.');
    }

    public function show(Request $request, Media $media)
    {
        if ($media->user_id !== $request->user()->id) {
            return $this->sendError('Unauthorized.', [], 403);
        }

        return $this->sendResponse($media, 'Media retrieved successfully.');
    }

    public function destroy(Request $request, Media $media)
    {
        if ($media->user_id !== $request->user()->id) {
            return $this->sendError('Unauthorized.', [], 403);
        }

        Storage::disk('public')->delete($media->filename);
        $media->delete();

        return $this->sendResponse([], 'Media deleted successfully.');
    }
}
