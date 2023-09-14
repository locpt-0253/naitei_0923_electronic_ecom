<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function changeLocale(Request $request)
    {
        $lang = $request->language;

        if (!in_array($lang, config('app.lang'))) {
            abort(400);
        }

        Session::put('language', $lang);

        return redirect()->back();
    }
}
