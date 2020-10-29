<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function listele()
    {
        return view('back.home.listele');
    }
}
