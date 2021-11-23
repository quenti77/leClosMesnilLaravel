<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    public function getContact(): View|Factory
    {
        return view('contact');
    }
}
