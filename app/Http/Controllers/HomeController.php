<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('back.index');
    }

    /*
     * ayarlar
     */
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

    /*
     * blog
     */
    public function blog()
    {
        return view('back.blog.blog-listele');
    }

    public function blog_ekle()
    {
        return view('back.blog.blog-ekle');
    }

    public function blog_ekle_post()
    {

    }

    public function blog_duzenle()
    {
        return view('back.blog.blog-duzenle');
    }

    public function blog_duzenle_post()
    {

    }

    public function blog_kategori()
    {
        return view('back.blog.blog-kategori-listele');
    }

    public function blog_kategori_ekle()
    {
        return view('back.blog.blog-kategori-ekle');
    }

    public function blog_kategori_ekle_post()
    {

    }

    public function  blog_kategori_duzenle()
    {
        return view('back.blog.blog-kategori-duzenle');
    }

    public function blog_kategori_duzenle_post()
    {

    }

    /*
     * blog
     */
}
