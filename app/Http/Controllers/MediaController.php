<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use App\Models\MediaView;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function myMedia()
    {
        $mediaItems = auth()->user()->media()->latest()->paginate(12);
        return view('media.my-media', compact('mediaItems'));
    }

    public function recentUploads()
    {
        $mediaItems = Media::where('is_public', true)->latest()->paginate(12);
        return view('media.recent-uploads', compact('mediaItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimetypes:video/mp4,image/jpeg,image/png,image/gif,image/webp|max:' . (env('MAX_FILE_SIZE', 50) * 1024),
            'is_public' => 'nullable|boolean',
        ]);

        $user = auth()->user();

        // Check storage limit (in bytes)
        $currentStorageUsed = $user->media()->sum('size');
        $fileSize = $request->file('file')->getSize();
        $storageLimitBytes = $user->storage_limit_mb * 1024 * 1024;

        if (($currentStorageUsed + $fileSize) > $storageLimitBytes) {
            return back()->with('error', __('content.storage_limit_exceeded') . ' (' . $user->storage_limit_mb . ' MB)');
        }

        $file = $request->file('file');
        $mime = $file->getMimeType();

        $isImage = Str::startsWith($mime, 'image/');
        $isVideo = Str::startsWith($mime, 'video/');

        if (!$isImage && !$isVideo) {
            return back()->with('error', __('Only images or videos are allowed.'));
        }

        $filePath = $file->store('media', 'public');
        $fileName = basename($filePath);

        $user->media()->create([
            'type' => $isVideo ? 'video' : 'image',
            'filename' => $fileName,
            'original_name' => $file->getClientOriginalName(),
            'mime' => $mime,
            'size' => $fileSize,
            'is_public' => $request->boolean('is_public'),
            'slug' => Str::random(7),
        ]);

        return back()->with('success', $isVideo ? __('content.video_uploaded') : __('content.media_uploaded'));
    }

    public function show(Request $request, Media $media)
    {
        if (!$request->boolean('is_preview')) {
            MediaView::create([
                'media_id' => $media->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'viewer_user_id' => Auth::id(),
            ]);
        }
        
        /*
		if (!$media->is_public && (auth()->guest() || auth()->id() !== $media->user_id)) {
            abort(403);
        }
		*/ //Just if you want the plattform as Users "Private Media Cloud"

        $path = Storage::disk('public')->path('media/' . $media->filename);

        if (!Storage::disk('public')->exists('media/' . $media->filename)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => $media->mime,
            'Content-Disposition' => 'inline; filename="' . $media->original_name . '"',
        ]);
    }

    public function destroy(Media $media)
    {
        if ($media->user_id !== auth()->id()) {
            abort(403);
        }

        if (Storage::disk('public')->exists('media/' . $media->filename)) {
            Storage::disk('public')->delete('media/' . $media->filename);
        }

        $media->delete();

        return back()->with('success', __('content.media_deleted'));
    }

    public function toggleVisibility(Request $request, Media $media)
    {
        if ($media->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'is_public' => 'required|boolean',
        ]);

        $media->is_public = $request->boolean('is_public');
        $media->save();

        return back()->with('success', __('content.visibility_updated'));
    }
}
