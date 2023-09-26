<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function changeLocale(Request $request)
    {
        $locale = $request->input('locale');
        $request->session()->put('locale', $locale);

        return back(); // Redirect back to the previous page or any desired location.
    }
}
