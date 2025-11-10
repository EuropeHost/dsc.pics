<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();

        $user->loadCount('media')->loadSum('media', 'size');

        $publicMediaCount = $user->media()->where('is_public', 1)->count();
        $privateMediaCount = $user->media()->where('is_public', 0)->count();

        // Determine avatar URL or use a fallback
        $avatarUrl = asset('img/default-avatar.png');
        if ($user->discord_id && $user->avatar) {
            $avatarUrl = "https://cdn.discordapp.com/avatars/{$user->discord_id}/{$user->avatar}.png";
        }
        $user->avatar_url = $avatarUrl;

        return view('profile.show', compact('user', 'publicMediaCount', 'privateMediaCount'));
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        Auth::logout();

        if ($user->media) {
            foreach ($user->media as $media) {
                if (Storage::disk('public')->exists($media->filename)) {
                    Storage::disk('public')->delete($media->filename);
                }
            }
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('home')->with('success', __('profile.account_deleted_success'));
    }
}
