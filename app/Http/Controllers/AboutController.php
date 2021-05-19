<?php 

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function getAbout()
    {
        return view('about');
    }
}