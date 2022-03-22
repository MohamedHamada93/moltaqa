<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    # home
    public function Home(Request $request)
    {
        return view('front.home.home');
    }
}
