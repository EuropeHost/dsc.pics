<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LocaleController extends Controller
{
    public function applySuggestion(Request $request)
    {
        if ($request->session()->has('suggested_locale')) {
            $suggestedLocale = $request->session()->get('suggested_locale');
            $request->session()->put('locale', $suggestedLocale);
            $request->session()->forget('suggested_locale');
        }

        return Redirect::back();
    }

    public function dismissSuggestion(Request $request)
    {
        $request->session()->put('locale', config('app.locale'));
        $request->session()->forget('suggested_locale');

        return Redirect::back();
    }
}