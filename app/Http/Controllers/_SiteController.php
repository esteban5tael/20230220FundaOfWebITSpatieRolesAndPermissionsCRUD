<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class _SiteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('welcome', compact('request'));
    }
}
