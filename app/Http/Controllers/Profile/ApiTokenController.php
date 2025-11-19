<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ApiToken;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{
    public function index()
    {
        $tokens = Auth::user()->apiTokens()->latest()->get();
        $permissions = config('permissions.abilities');
        $descriptions = config('permissions.descriptions');
        return view('profile.api.index', compact('tokens', 'permissions', 'descriptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'nullable|array',
            'abilities.*' => 'string',
        ]);

        $token = Str::random(40);
        $hashedToken = hash('sha256', $token);

        $apiToken = Auth::user()->apiTokens()->create([
            'name' => $request->name,
            'token' => $hashedToken,
            'abilities' => $request->abilities ?? [],
        ]);

        session()->flash('new-token', $token);
        session()->flash('token-name', $apiToken->name);

        return redirect()->route('profile.api-tokens.index')->with('success', __('api.token_created'));
    }

    public function destroy(ApiToken $apiToken)
    {
        if ($apiToken->user_id !== Auth::id()) {
            abort(403);
        }

        $apiToken->delete();

        return redirect()->route('profile.api-tokens.index')->with('success', __('api.token_deleted'));
    }
}