<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ApiToken;
use Illuminate\Support\Facades\Auth;

class ApiPlaygroundController extends Controller
{
    public function index()
    {
        return view('pages.api-playground');
    }

    public function data()
    {
        $user = Auth::user();
        $tokens = $user->apiTokens->map(function ($token) {
            return [
                'id' => $token->id,
                'name' => $token->name,
                'token' => $token->token,
            ];
        });

        $allRoutes = Route::getRoutes();
        $v1Routes = [];
        $v2Routes = [];

        foreach ($allRoutes as $route) {
            $uri = $route->uri();
            $methods = $route->methods();

            // Skip HEAD requests and the playground data route itself
            if (in_array('HEAD', $methods) || $uri === 'api/playground-data') {
                continue;
            }
            
            $routeInfo = [
                'uri' => $uri,
                'method' => $methods[0], // Assuming one method per route for simplicity
                'middleware' => $route->gatherMiddleware(),
            ];

            if (str_starts_with($uri, 'api/v2')) {
                $routeInfo['uri'] = substr($uri, 7); // Remove 'api/v2/'
                $v2Routes[] = $routeInfo;
            } elseif (str_starts_with($uri, 'api/')) {
                $routeInfo['uri'] = substr($uri, 4); // Remove 'api/'
                $v1Routes[] = $routeInfo;
            }
        }

        return response()->json([
            'tokens' => $tokens,
            'routes' => [
                'v1' => $v1Routes,
                'v2' => $v2Routes,
            ],
        ]);
    }
}
