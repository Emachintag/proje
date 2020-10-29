<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('back.index');
    }

    public function sosyal_medya_ayarlar()
    {
        return view('back.ayarlar.sosyal-medya');
    }

    public function site_ayarlar()
    {
        return view('back.ayarlar.site-ayarlar');
    }

    public function iletisim_ayarlar()
    {
        return view('back.ayarlar.iletisim-ayarlar');
    }
}
