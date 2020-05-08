<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
    public function setLanguage($lang)
    {
        if ($lang == 'lt') {
            \App::setLocale('lt');
            Session::put('locale', 'lt');
        } else {
            \App::setLocale('en');
            Session::put('locale', 'en');
        }

        return redirect()->back();
    }
}
