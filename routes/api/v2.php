<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V2\MediaController;
use App\Http\Controllers\Api\V2\LinkController;
use App\Http\Controllers\Api\V2\StatsController;

// Public routes
Route::get('/stats', [StatsController::class, 'index']);
Route::get('/stats/users', [StatsController::class, 'users']);
Route::get('/stats/media', [StatsController::class, 'media']);
Route::get('/stats/links', [StatsController::class, 'links']);

Route::middleware('auth:sanctum')->group(function () {
    // Media
    Route::get('/media', [MediaController::class, 'index'])->middleware('ability:media:read');
    Route::post('/media', [MediaController::class, 'store'])->middleware('ability:media:create');
    Route::get('/media/{media}', [MediaController::class, 'show'])->middleware('ability:media:read');
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])->middleware('ability:media:delete');

    // Links
    Route::get('/links', [LinkController::class, 'index'])->middleware('ability:links:read');
    Route::post('/links', [LinkController::class, 'store'])->middleware('ability:links:create');
    Route::get('/links/{link}', [LinkController::class, 'show'])->middleware('ability:links:read');
    Route::delete('/links/{link}', [LinkController::class, 'destroy'])->middleware('ability:links:delete');
});
