<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('anasayfa');
Route::get('/hakkimizda', [MainController::class, 'hakkimizda'])->name('hakkimizda');
Route::get('/iletisim', [MainController::class, 'iletisim'])->name('iletisim');
Route::post('/iletisim', [MainController::class, 'iletisim_post']);
Route::get('/galeri', [MainController::class, 'galeri'])->name('galeriler');
Route::get('/vizyon', [MainController::class, 'vizyon'])->name('vizyon');
Route::get('/misyon', [MainController::class, 'misyon'])->name('misyon');

Route::get('/sakaryamiz', [MainController::class, 'sakarya'])->name('sakarya');
Route::get('/tarim-makinalari', [MainController::class, 'tarim'])->name('tarim');

Route::get('/belgeler', [MainController::class, 'belgeler'])->name('belgeler');
Route::get('/ekibimiz', [MainController::class, 'ekibimiz'])->name('ekibimiz');
Route::get('/urunlerimiz', [MainController::class, 'urunlerimiz'])->name('urunlerimiz');
Route::get('/urun/{urun}', [MainController::class, 'urun'])->name('urun_detay');
Route::get('/haberler', [MainController::class, 'haberler'])->name('haberler');
Route::get('/haber/{haber}', [MainController::class, 'haber'])->name('haber');
Route::get('/blog', [MainController::class, 'blog'])->name('blog');
Route::get('/blog/{blog}', [MainController::class, 'blog_detay'])->name('blog_detay');
Route::get('/hizmetler', [MainController::class, 'hizmetler'])->name('hizmetler');
Route::get('/hizmet-detay/{hizmet}', [MainController::class, 'hizmet'])->name('hizmet');


Route::get('/giris', [LoginController::class, 'login'])->name('giris');
Route::post('/giris', [LoginController::class, 'login_post']);
Route::get('/cikis', [LoginController::class, 'logout'])->name('cikis');

Auth::routes();
Route::prefix('panel')->middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/sosyal-medya-ayarlar', [HomeController::class, 'sosyal_medya_ayarlar'])->name('sosyal_medya_ayarlar')->middleware('auth');
    Route::post('/sosyal-medya-ayarlar', [HomeController::class, 'sosyal_medya_ayarlar_post'])->middleware('auth');
    Route::get('/site-ayarlar', [HomeController::class, 'site_ayarlar'])->name('site_ayarlar')->middleware('auth');
    Route::post('/site-ayarlar', [HomeController::class, 'site_ayarlar_post'])->middleware('auth');
    Route::get('/iletisim-ayarlar', [HomeController::class, 'iletisim_ayarlar'])->name('iletisim_ayarlar')->middleware('auth');
    Route::post('/iletisim-ayarlar', [HomeController::class, 'iletisim_ayarlar_post'])->middleware('auth');
    Route::get('/hakkimizda-ayarlar', [HomeController::class, 'hakkimizda_ayarlar'])->name('hakkimizda_ayarlar')->middleware('auth');
    Route::post('/hakkimizda-ayarlar', [HomeController::class, 'hakkimizda_ayarlar_post'])->middleware('auth');
    Route::get('/ekatalog-ayarlar', [HomeController::class, 'ekatalog_ayarlar'])->name('ekatalog_ayarlar')->middleware('auth');
    Route::post('/ekatalog-ayarlar', [HomeController::class, 'ekatalog_ayarlar_post'])->middleware('auth');
    Route::get('/vizyon-ayarlar', [HomeController::class, 'vizyon_ayarlar'])->name('vizyon_ayarlar')->middleware('auth');
    Route::post('/vizyon-ayarlar', [HomeController::class, 'vizyon_ayarlar_post'])->middleware('auth');
    Route::get('/misyon-ayarlar', [HomeController::class, 'misyon_ayarlar'])->name('misyon_ayarlar')->middleware('auth');
    Route::post('/misyon-ayarlar', [HomeController::class, 'misyon_ayarlar_post'])->middleware('auth');

    Route::get('/tarim-makina-ayarlar', [HomeController::class, 'tarim_ayarlar'])->name('tarim_ayarlar')->middleware('auth');
    Route::post('/tarim-makina-ayarlar', [HomeController::class, 'tarim_ayarlar_post'])->middleware('auth');
    Route::get('/sakarya-ayarlar', [HomeController::class, 'sakarya_ayarlar'])->name('sakarya_ayarlar')->middleware('auth');
    Route::post('/sakarya-ayarlar', [HomeController::class, 'sakarya_ayarlar_post'])->middleware('auth');

    // Blog İşlemleri Başlangıç

    Route::get('/blog', [HomeController::class, 'blog'])->name('blog')->middleware('auth');
    Route::get('/blog-ekle', [HomeController::class, 'blog_ekle'])->name('blog_ekle')->middleware('auth');
    Route::post('/blog-ekle', [HomeController::class, 'blog_ekle_post'])->middleware('auth');
    Route::get('/blog-duzenle', [HomeController::class, 'blog_duzenle'])->name('blog_duzenle')->middleware('auth');
    Route::post('/blog-duzenle', [HomeController::class, 'blog_duzenle_post']);
    Route::get('/blog-kategori', [HomeController::class, 'blog_kategori'])->name('blog_kategori');
    Route::get('/blog-kategori-ekle', [HomeController::class, 'blog_kategori_ekle'])->name('blog_kategori_ekle');
    Route::post('/blog-kategori-ekle', [HomeController::class, 'blog_kategori_ekle_post']);
    Route::get('/blog-kategori-duzenle', [HomeController::class, 'blog_kategori_duzenle'])->name('blog_kategori_duzenle');
    Route::post('/blog-kategori-duzenle', [HomeController::class, 'blog_kategori_duzenle_post']);

    // Blog İşlemleri Bitiş

    // İnsan Kaynakları

    Route::get('/basvuru', [HomeController::class, 'basvuru'])->name('basvuru')->middleware('auth');
    Route::get('/insan-kaynaklari', [HomeController::class, 'insan'])->name('insanlar')->middleware('auth');
    Route::get('/insan-kaynaklari-ekle', [HomeController::class, 'insan_ekle'])->name('insan_ekle')->middleware('auth');
    Route::post('/insan-kaynaklari-ekle', [HomeController::class, 'insan_ekle_post'])->middleware('auth');
    Route::get('/insan-kaynaklari-duzenle', [HomeController::class, 'insan_duzenle'])->name('insan_duzenle')->middleware('auth');
    Route::post('/insan-kaynaklari-duzenle', [HomeController::class, 'insan_duzenle_post']);

    // İnsan Kaynakları


    // Belge İşlemleri Başlangıç

    Route::get('/belge', [HomeController::class, 'belge'])->name('belge');
    Route::get('/belge-ekle', [HomeController::class, 'belge_ekle'])->name('belge_ekle');
    Route::post('/belge-ekle', [HomeController::class, 'belge_ekle_post']);
    Route::get('/belge-duzenle', [HomeController::class, 'belge_duzenle'])->name('belge_duzenle');
    Route::post('/belge-duzenle', [HomeController::class, 'belge_duzenle_post']);

    // Belge İşlemleri Bitiş



    Route::get('/profil-bilgileri', [HomeController::class, 'profil'])->name('profil');
    Route::post('/profil-bilgileri', [HomeController::class, 'profil_post']);
    Route::get('/sifre-bilgileri', [HomeController::class, 'sifre'])->name('sifre');
    Route::post('/sifre-bilgileri', [HomeController::class, 'sifre_post']);


    // Üye İşlemleri Başlangıç

    Route::get('/uyeler', [HomeController::class, 'uyeler'])->name('uyeler');
    Route::get('/uye-ekle', [HomeController::class, 'uye_ekle'])->name('uye_ekle');
    Route::post('/uye-ekle', [HomeController::class, 'uye_ekle_post']);
    Route::get('/uye-duzenle', [HomeController::class, 'uye_duzenle'])->name('uye_duzenle');
    Route::post('/uye-duzenle', [HomeController::class, 'uye_duzenle_post']);

    // Üye İşlemleri Bitiş



    // Galeri İşlemleri Başlangıç

    Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
    Route::get('/galeri-ekle', [HomeController::class, 'galeri_ekle'])->name('galeri_ekle');
    Route::post('/galeri-ekle', [HomeController::class, 'galeri_ekle_post']);
    Route::get('/galeri-duzenle', [HomeController::class, 'galeri_duzenle'])->name('galeri_duzenle');
    Route::post('/galeri-duzenle', [HomeController::class, 'galeri_duzenle_post']);

    // Galeri İşlemleri Bitiş

    // Marka İşlemleri Başlangıç

    Route::get('/soru', [HomeController::class, 'soru'])->name('soru');
    Route::get('/soru-ekle', [HomeController::class, 'soru_ekle'])->name('soru_ekle');
    Route::post('/soru-ekle', [HomeController::class, 'soru_ekle_post']);
    Route::get('/soru-duzenle', [HomeController::class, 'soru_duzenle'])->name('soru_duzenle');
    Route::post('/soru-duzenle', [HomeController::class, 'soru_duzenle_post']);

    // Marka İşlemleri Bitiş


    // Yorum İşlemleri Başlangıç

    Route::get('/yorum', [HomeController::class, 'yorum'])->name('yorum');
    Route::get('/yorum-ekle', [HomeController::class, 'yorum_ekle'])->name('yorum_ekle');
    Route::post('/yorum-ekle', [HomeController::class, 'yorum_ekle_post']);
    Route::get('/yorum-duzenle', [HomeController::class, 'yorum_duzenle'])->name('yorum_duzenle');
    Route::post('/yorum-duzenle', [HomeController::class, 'yorum_duzenle_post']);

    // Yorum İşlemleri Bitiş



    // Marka İşlemleri Başlangıç

    Route::get('/marka', [HomeController::class, 'marka'])->name('marka');
    Route::get('/marka-ekle', [HomeController::class, 'marka_ekle'])->name('marka_ekle');
    Route::post('/marka-ekle', [HomeController::class, 'marka_ekle_post']);
    Route::get('/marka-duzenle', [HomeController::class, 'marka_duzenle'])->name('marka_duzenle');
    Route::post('/marka-duzenle', [HomeController::class, 'marka_duzenle_post']);

    // Marka İşlemleri Bitiş



    // Ekip İşlemleri Başlangıç

    Route::get('/ekip', [HomeController::class, 'ekip'])->name('ekip');
    Route::get('/ekip-ekle', [HomeController::class, 'ekip_ekle'])->name('ekip_ekle');
    Route::post('/ekip-ekle', [HomeController::class, 'ekip_ekle_post']);
    Route::get('/ekip-duzenle', [HomeController::class, 'ekip_duzenle'])->name('ekip_duzenle');
    Route::post('/ekip-duzenle', [HomeController::class, 'ekip_duzenle_post']);

    // Ekip İşlemleri Bitiş


    // Haber İşlemleri Başlangıç

    Route::get('/haber', [HomeController::class, 'haber'])->name('haber');
    Route::get('/haber-ekle', [HomeController::class, 'haber_ekle'])->name('haber_ekle');
    Route::post('/haber-ekle', [HomeController::class, 'haber_ekle_post']);
    Route::get('/haber-duzenle', [HomeController::class, 'haber_duzenle'])->name('haber_duzenle');
    Route::post('/haber-duzenle', [HomeController::class, 'haber_duzenle_post']);
    Route::get('/haber-kategori', [HomeController::class, 'haber_kategori'])->name('haber_kategori');
    Route::get('/haber-kategori-ekle', [HomeController::class, 'haber_kategori_ekle'])->name('haber_kategori_ekle');
    Route::post('/haber-kategori-ekle', [HomeController::class, 'haber_kategori_ekle_post']);
    Route::get('/haber-kategori-duzenle', [HomeController::class, 'haber_kategori_duzenle'])->name('haber_kategori_duzenle');
    Route::post('/haber-kategori-duzenle', [HomeController::class, 'haber_kategori_duzenle_post']);

    // Haber İşlemleri Bitiş

    // Hizmet İşlemleri Başlangıç

    Route::get('/hizmet', [HomeController::class, 'hizmet'])->name('hizmet');
    Route::get('/hizmet-ekle', [HomeController::class, 'hizmet_ekle'])->name('hizmet_ekle');
    Route::post('/hizmet-ekle', [HomeController::class, 'hizmet_ekle_post']);
    Route::get('/hizmet-duzenle', [HomeController::class, 'hizmet_duzenle'])->name('hizmet_duzenle');
    Route::post('/hizmet-duzenle', [HomeController::class, 'hizmet_duzenle_post']);
    Route::get('/hizmet-kategori', [HomeController::class, 'hizmet_kategori'])->name('hizmet_kategori');
    Route::get('/hizmet-kategori-ekle', [HomeController::class, 'hizmet_kategori_ekle'])->name('hizmet_kategori_ekle');
    Route::post('/hizmet-kategori-ekle', [HomeController::class, 'hizmet_kategori_ekle_post']);
    Route::get('/hizmet-kategori-duzenle', [HomeController::class, 'hizmet_kategori_duzenle'])->name('hizmet_kategori_duzenle');
    Route::post('/hizmet-kategori-duzenle', [HomeController::class, 'hizmet_kategori_duzenle_post']);

    // Hizmet İşlemleri Bitiş

    // Slider İşlemleri Başlangıç

    Route::get('/slider', [HomeController::class, 'slider'])->name('slider');
    Route::get('/slider-ekle', [HomeController::class, 'slider_ekle'])->name('slider_ekle');
    Route::post('/slider-ekle', [HomeController::class, 'slider_ekle_post']);
    Route::get('/slider-duzenle', [HomeController::class, 'slider_duzenle'])->name('slider_duzenle');
    Route::post('/slider-duzenle', [HomeController::class, 'slider_duzenle_post']);

    // Slider İşlemleri Bitiş


    // Ürün İşlemleri Başlangıç

    Route::get('/urun', [HomeController::class, 'urun'])->name('urun');
    Route::get('/urun-ekle', [HomeController::class, 'urun_ekle'])->name('urun_ekle');
    Route::post('/urun-ekle', [HomeController::class, 'urun_ekle_post']);
    Route::get('/urun-duzenle', [HomeController::class, 'urun_duzenle'])->name('urun_duzenle');
    Route::post('/urun-duzenle', [HomeController::class, 'urun_duzenle_post']);
    Route::get('/urun-kategori', [HomeController::class, 'urun_kategori'])->name('urun_kategori');
    Route::get('/urun-kategori-ekle', [HomeController::class, 'urun_kategori_ekle'])->name('urun_kategori_ekle');
    Route::post('/urun-kategori-ekle', [HomeController::class, 'urun_kategori_ekle_post']);
    Route::get('/urun-kategori-duzenle', [HomeController::class, 'urun_kategori_duzenle'])->name('urun_kategori_duzenle');
    Route::post('/urun-kategori-duzenle', [HomeController::class, 'urun_kategori_duzenle_post']);

    // Ürün İşlemleri Bitiş


    // Üye İşlemleri Başlangıç

    Route::get('/uye', [HomeController::class, 'uye'])->name('uye');
    Route::get('/uye-ekle', [HomeController::class, 'uye_ekle'])->name('uye_ekle');
    Route::post('/uye-ekle', [HomeController::class, 'uye_ekle_post']);
    Route::get('/uye-duzenle', [HomeController::class, 'uye_duzenle'])->name('uye_duzenle');
    Route::post('/uye-duzenle', [HomeController::class, 'uye_duzenle_post']);

    // Üye İşlemleri Bitiş

    /*
        foreach (Modules::where('status', '1')->get() as $u) {
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
        }
    */
});
