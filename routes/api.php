<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\ApiPlaygroundController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
|
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public API Routes
Route::get('/stats/global', [StatsController::class, 'globalStats']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/playground/v2-details', [ApiPlaygroundController::class, 'getV2ApiDetails'])->name('api.playground.v2-details');
});


