<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class AboutController extends Controller
{
    public function getAbout(): View|Factory
    {
        return view('about');
    }
}
