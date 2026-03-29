<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function update(Request $request, string $locale): RedirectResponse
    {
        $supportedLocales = config('app.supported_locales', ['en']);

        if (in_array($locale, $supportedLocales, true)) {
            $request->session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
