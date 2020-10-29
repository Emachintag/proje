<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Models\Modules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/giris', [LoginController::class, 'login'])->name('giris');
Route::post('/giris', [LoginController::class, 'login_post']);

Auth::routes();
Route::prefix('panel')->group(function () {

    foreach (Modules::where('status', '1')->get() as $u) {
        $moduleLink = $u->moduleLink;
        $moduleController = $u->moduleController;
        $space = "App\Http\Controllers\\";
        $controller = $space.$moduleController;
        $moduleSlug = $u->moduleSlug;
        Route::get($moduleLink, $controller.'@'.$moduleSlug.'_listele')->name($moduleSlug);
        Route::get($moduleLink, $controller.'@'.$moduleSlug.'_ekle')->name($moduleSlug.'_ekle');
        Route::post($moduleLink, $controller.'@'.$moduleSlug.'_ekle_post')->name($moduleSlug.'_ekle_post');
        Route::get($moduleLink, $controller.'@'.$moduleSlug.'_duzenle')->name($moduleSlug.'_duzenle');
        Route::post($moduleLink, $controller.'@'.$moduleSlug.'_duzenle_post')->name($moduleSlug.'_duzenle_post');
    }

});
