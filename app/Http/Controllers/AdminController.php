<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $totalUsers = User::count();
        $totalImages = Image::count();
        $totalStorageUsedBytes = Image::sum('size');
        $totalStorageUsedMB = $totalStorageUsedBytes / 1024 / 1024;
        $totalLinks = Link::count();

        $systemStorageLimitBytes = (int)env('SYSTEM_STORAGE_LIMIT_GB', 1024) * 1024 * 1024 * 1024;
        $systemStoragePercentage = ($systemStorageLimitBytes > 0) ? ($totalStorageUsedBytes / $systemStorageLimitBytes) * 100 : 0;
        $systemStoragePercentage = min(100, $systemStoragePercentage);

        $users = User::withCount('images')
                     ->withSum('images', 'size')
                     ->withCount('links')
                     ->orderBy('created_at', 'desc')
                     ->paginate(15);

        $users->getCollection()->transform(function ($user) {
            $avatarUrl = asset('img/default-avatar.png');
            if ($user->discord_id && $user->avatar) {
                $avatarUrl = "https://cdn.discordapp.com/avatars/{$user->discord_id}/{$user->avatar}.png";
            }
            $user->avatar_url = $avatarUrl;
            return $user;
        });

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalImages',
            'totalStorageUsedMB',
            'systemStorageLimitBytes',
            'systemStoragePercentage',
            'users',
            'totalLinks'
        ));
    }

	public function showUser(User $user)
	{
	    $user->loadCount(['images', 'links'])->loadSum('images', 'size');
	
	    $userImages = $user->images()->latest()->paginate(8, ['*'], 'images_page')->withQueryString();
	
	    $userLinks = $user->links()->withCount('views')->latest()->paginate(10, ['*'], 'links_page')->withQueryString();
	
	    $user->avatar_url = $user->discord_id && $user->avatar
	        ? "https://cdn.discordapp.com/avatars/{$user->discord_id}/{$user->avatar}.png"
	        : asset('img/default-avatar.png');
	
	    $totalUserLinkViews = $user->links()->withCount('views')->get()->sum('views_count');
	
	    return view('admin.user_insights', compact('user', 'userImages', 'userLinks', 'totalUserLinkViews'));
	}

    public function updateRole(Request $request, User $user)
    {
        if (auth()->user()->id === $user->id) {
            return Redirect::back()->with('error', __('admin.cannot_change_own_role'));
        }

        $validated = $request->validate([
            'role' => ['required', 'in:user,admin'],
        ]);

        $user->role = $validated['role'];
        $user->save();

        return Redirect::back()->with('success', __('admin.role_updated_successfully', ['user_name' => $user->name]));
    }

    public function destroy(User $user)
    {
        if (auth()->user()->id === $user->id) {
            return Redirect::back()->with('error', __('admin.cannot_delete_own_account'));
        }

		foreach ($user->images as $image) {
		    if (Storage::disk('public')->exists($image->filename)) {
		        Storage::disk('public')->delete($image->filename);
		    }
		    $image->delete();
		}
		
        $user->links()->delete();

        $user->delete();

        return Redirect::route('admin.dashboard')->with('success', __('admin.user_deleted_successfully', ['user_name' => $user->name]));
    }
}
