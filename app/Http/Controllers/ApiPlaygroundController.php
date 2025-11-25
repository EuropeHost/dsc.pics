<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route as IlluminateRoute;
use Closure;

class ApiPlaygroundController extends Controller
{
    /**
     * Display the API playground view.
     */
    public function index()
    {
        return view('pages.api-playground');
    }
}
