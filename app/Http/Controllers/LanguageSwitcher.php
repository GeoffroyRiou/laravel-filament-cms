<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageSwitcher extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        session(['language' => $request->get('language')]);

        return redirect()->route('home');
    }
}
