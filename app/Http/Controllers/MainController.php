<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function hakkimizda()
    {
        return view('hakkimizda');
    }

    public function iletisim()
    {
        return view('iletisim');
    }

    public function urunlerimiz()
    {
        return view('urunlerimiz');
    }

    public function urun($urun)
    {
        return view('urun')->with('id', $urun);
    }

    public function haberler()
    {
        return view('haberler');
    }

    public function haber($haber) {
        return view('haber')->with('id', $haber);
    }

    public function blog()
    {
        return view('blog');
    }

    public function blog_detay($blog) {
        return view('blog_detay')->with('id', $blog);
    }

    public function hizmetlerimiz()
    {
        return view ('hizmetlerimiz');
    }

    public function hizmet($hizmet) {
        return view('hizmet')->with('id', $hizmet);
    }
}
