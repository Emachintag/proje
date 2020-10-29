<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::get('/', [MainController::class, 'index'])->name('anasayfa');
Route::get('/giris', [LoginController::class, 'login'])->name('giris');
Route::post('/giris', [LoginController::class, 'login_post']);

Auth::routes();
Route::prefix('panel')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/sosyal-medya-ayarlar', [HomeController::class, 'sosyal_medya_ayarlar'])->name('sosyal_medya_ayarlar');
    Route::post('/sosyal-medya-ayarlar', [HomeController::class, 'sosyal_medya_ayarlar_post']);
    Route::get('/site-ayarlar', [HomeController::class, 'site_ayarlar'])->name('site_ayarlar');
    Route::post('/site-ayarlar', [HomeController::class, 'site_ayarlar_post']);
    Route::get('/iletisim-ayarlar', [HomeController::class, 'iletisim_ayarlar'])->name('iletisim_ayarlar');
    Route::post('/iletisim-ayarlar', [HomeController::class, 'iletisim_ayarlar_post']);

    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('/blog-ekle', [HomeController::class, 'blog_ekle'])->name('blog_ekle');
    Route::post('/blog-ekle', [HomeController::class, 'blog_ekle_post']);
    Route::get('/blog-duzenle', [HomeController::class, 'blog_duzenle'])->name('blog_duzenle');
    Route::post('/blog-duzenle', [HomeController::class, 'blog_duzenle_post']);
    Route::get('/blog-kategori', [HomeController::class, 'blog_kategori'])->name('blog_kategori');
    Route::get('/blog-kategori-ekle', [HomeController::class, 'blog_kategori_ekle'])->name('blog_kategori_ekle');
    Route::post('/blog-kategori-ekle', [HomeController::class, 'blog_kategori_ekle_post']);
    Route::get('/blog-kategori-duzenle', [HomeController::class, 'blog_kategori_duzenle'])->name('blog_kategori_duzenle');
    Route::post('/blog-kategori-duzenle', [HomeController::class, 'blog_kategori_duzenle_post']);

    /*foreach (Modules::where('status', '1')->get() as $u) {
        $moduleLink = $u->moduleLink;
        $moduleController = $u->moduleController;
        $space = "App\Http\Controllers\\";
        $controller = $space.$moduleController;
        $moduleSlug = $u->moduleSlug;
        Route::get($moduleLink, $controller.'@listele')->name($moduleSlug);
        Route::get($moduleLink, $controller.'@ekle')->name($moduleSlug.'_ekle');
        Route::post($moduleLink, $controller.'@ekle_post')->name($moduleSlug.'_ekle_post');
        Route::get($moduleLink, $controller.'@duzenle')->name($moduleSlug.'_duzenle');
        Route::post($moduleLink, $controller.'@duzenle_post')->name($moduleSlug.'_duzenle_post');
    }*/

});
