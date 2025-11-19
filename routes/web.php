<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Profile\ApiTokenController;
use Illuminate\Http\Request;

Route::post('/locale/apply', [LocaleController::class, 'applySuggestion'])->name('locale.apply');
Route::post('/locale/dismiss', [LocaleController::class, 'dismissSuggestion'])->name('locale.dismiss');

Route::post('/locale', function (Request $request) {
    $locale = $request->input('locale');
    if (!array_key_exists($locale, config('app.locales'))) { return back()->with('error', __('content.invalid_locale_selected')); }
    session(['locale' => $locale]);
    return back()->with('success', __('content.locale_switched_to', ['language' => config('app.locales')[$locale]],),); // TODO: display in the updated locale (curretnly uses the locale it was set bevior swiztch)
})->name('set-locale');

//Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/', [PageController::class, 'lander'])->name('home');

Route::get('/auth/redirect', [AuthController::class, 'redirectToDiscord'])->name('login');
Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login.view');
Route::get('/auth/callback', [AuthController::class, 'handleDiscordCallback']);

Route::middleware('auth')->group(function () {
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
	
    Route::get('/my-media', [MediaController::class, 'myMedia'])->name('media.my');
    Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
	Route::patch('/media/{media}/visibility', [MediaController::class, 'toggleVisibility'])->name('media.toggleVisibility');

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::redirect('/', '/admin/dashboard');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
        Route::get('/users/{user}/activity', [AdminController::class, 'userActivity'])->name('users.activity');
        Route::patch('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.update_role');
        Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
    });

    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/activity', [ProfileController::class, 'activity'])->name('activity');
        Route::resource('api-tokens', ApiTokenController::class)->except(['show', 'edit', 'update']);
        Route::get('api-tokens/{api_token}/activity', [ApiTokenController::class, 'activity'])->name('api-tokens.activity');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    //Link Management Routes
    Route::prefix('links')->name('links.')->group(function () {
        Route::get('/my', [LinkController::class, 'myLinks'])->name('my');
        Route::post('/', [LinkController::class, 'store'])->name('store');
        Route::delete('/{link}', [LinkController::class, 'destroy'])->name('destroy');
    });
});

Route::get('/i/{media:slug}', [MediaController::class, 'show'])->name('img.show.slug');
Route::get('/v/{media:slug}', [MediaController::class, 'show'])->name('vid.show.slug');
Route::get('/l/{link:slug}', [LinkController::class, 'show'])->name('links.show');

Route::get('/media/{media}', [MediaController::class, 'show'])->name('media.show');

Route::get('/recent-uploads', [MediaController::class, 'recentUploads'])->name('media.recent');

Route::get('/legal/{section}', [PageController::class, 'legal'])->name('pages.legal');

Route::post('/announcement/dismiss/{id}', function ($id) {
    session()->put("announcement_dismissed_{$id}", true);
    return back();
})->name('announcement.dismiss');
