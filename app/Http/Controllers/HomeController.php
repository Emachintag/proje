<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

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

    public function sosyal_medya_ayarlar_post (Request $request)
    {
        DB::table('sosyal_medya_ayarlar')->where('id', '1')->update([
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),
            'instagram' => $request->input('instagram'),
            'youtube' => $request->input('youtube'),
            'linkedin' => $request->input('linkedin'),

        ]);

        return back()->with('success', 'Sosyal medya bilgileri başarıyla güncellendi.');
    }

    public function site_ayarlar()
    {
        return view('back.ayarlar.site-ayarlar');
    }

    public function site_ayarlar_post (Request $request)
    {


        if(isset($request->site_favicon)) {

            $info = getimagesize($request->site_favicon);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->site_favicon->move(public_path('img'), $imageName);
            DB::table('site_ayarlar')->where('id', 1)->update(['site_favicon' => $imageName]);
        }
        if(isset($request->site_logo)) {

            $info = getimagesize($request->site_logo);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->site_logo->move(public_path('img'), $imageName);
            DB::table('site_ayarlar')->where('id', 1)->update(['site_logo' => $imageName]);
        }
        DB::table('site_ayarlar')->where('id', '1')->update([
            'site_name' => $request->input('site_name'),
            'site_description' => $request->input('site_description'),
            'site_footer_text' => $request->input('site_footer_text'),
            'site_google' => $request->input('site_google'),

        ]);

        return back()->with('success', 'Site bilgileri başarıyla güncellendi.');

    }

    public function iletisim_ayarlar()
    {
        return view('back.ayarlar.iletisim-ayarlar');
    }

    public function iletisim_ayarlar_post (Request $request)
    {
        DB::table('iletisim_ayarlar')->where('id', '1')->update([
            'email' => $request->input('email'),
            'email_2' => $request->input('email_2'),
            'adres' => $request->input('adres'),
            'iframe' => $request->input('iframe'),
            'tel_1' => $request->input('tel_1'),
            'tel_2' => $request->input('tel_2'),
            'tel_3' => $request->input('tel_3'),

        ]);
        return back()->with('success', 'İletişim bilgileri başarıyla güncellendi.');
    }

    //Blog

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

    public function blog_kategori_duzenle()
    {
        return view('back.blog.blog-kategori-duzenle');
    }

    public function blog_kategori_duzenle_post()
    {

    }
     //Blog


    // Belge

    public function belge()
    {
        return view('back.belge.belge-listele');
    }

    public function belge_ekle()
    {
        return view('back.belge.belge-ekle');
    }

    public function belge_ekle_post()
    {

    }

    public function belge_duzenle()
    {
        return view('back.belge.belge-duzenle');
    }

    public function belge_duzenle_post()
    {

    }

    // Belge


    // Ekip

    public function ekip()
    {
        return view('back.ekip.ekip-listele');
    }

    public function ekip_ekle()
    {
        return view('back.ekip.ekip-ekle');
    }

    public function ekip_ekle_post()
    {

    }

    public function ekip_duzenle()
    {
        return view('back.ekip.ekip-duzenle');
    }

    public function ekip_duzenle_post()
    {

    }

    // Ekip


    // Galeri

    public function galeri()
    {
        return view('back.galeri.galeri-listele');
    }

    public function galeri_ekle()
    {
        return view('back.galeri.galeri-ekle');
    }

    public function galeri_ekle_post()
    {

    }

    public function galeri_duzenle()
    {
        return view('back.galeri.galeri-duzenle');
    }

    public function galeri_duzenle_post()
    {

    }

    // Galeri


    // Haber

    public function haber()
    {
        return view('back.haber.haber-listele');
    }

    public function haber_ekle()
    {
        return view('back.haber.haber-ekle');
    }

    public function haber_ekle_post(Request $request)
    {


        $url = Str::slug($request->input('title'), '-');
        DB::table('haber')->insert([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'kategori' => $request->input('kategori'),
            'text' => $request->input('text'),
            'url' => $url,
        ]);
        $lastId = DB::table('haber')->get()->last()->id;
        if(isset($request->pdf)) {
            $pdfName = time().".pdf";
            $request->pdf->move(public_path('img'), $pdfName);
            DB::table('haber')->where('id', $lastId)->update([
                'pdf' => $pdfName,
            ]);
        }
        if(isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);
            DB::table('haber')->where('id', $lastId)->update([
                'image' => $imageName,
            ]);
        }
        if($request->hasfile('pdfs'))
        {
            $i = 1;
            foreach($request->file('pdfs') as $image)
            {
                $extension = $image->getClientOriginalExtension();
                $pdfName = $url."-".$i."-".$image->getClientOriginalName();
                $pdfFirstName = explode(".", $pdfName);
                $pdfName = Str::slug($pdfFirstName[0], '-');
                $pdfName = $pdfName.".".$extension;
                $image->move(public_path('img'), $pdfName);
                DB::table('haber_belge')->insert([
                    'haber_id' => $lastId,
                    'belge' => $pdfName,
                ]);
                $i = $i + 1;
            }
        }
        if($request->hasfile('images'))
        {
            $i = 0;
            foreach($request->file('images') as $image)
            {
                $info = getimagesize($image);
                $extension = image_type_to_extension($info[2]);
                $imageName = time().$i.$extension;
                $image->move(public_path().'/img/', $imageName);
                DB::table('haber_gorsel')->insert([
                    'haber_id' => $lastId,
                    'gorsel' => $imageName,
                ]);
                $i = $i + 1;
            }
        }
        return redirect()->route('haber')->with('success', 'Yeni ürün başarıyla eklendi.');

    }

    public function haber_duzenle()
    {
        return view('back.haber.haber-duzenle');
    }

    public function haber_duzenle_post()
    {

    }

    public function haber_kategori()
    {
        return view('back.haber.haber-kategori-listele');
    }

    public function haber_kategori_ekle()
    {
        return view('back.haber.haber-kategori-ekle');
    }

    public function haber_kategori_ekle_post()
    {

    }

    public function haber_kategori_duzenle()
    {
        return view('back.haber.haber-kategori-duzenle');
    }

    public function haber_kategori_duzenle_post()
    {

    }

    // Haber



    // Hizmet

    public function hizmet()
    {
        return view('back.hizmet.hizmet-listele');
    }

    public function hizmet_ekle()
    {
        return view('back.hizmet.hizmet-ekle');
    }

    public function hizmet_ekle_post()
    {

    }

    public function hizmet_duzenle()
    {
        return view('back.hizmet.hizmet-duzenle');
    }

    public function hizmet_duzenle_post()
    {

    }

    public function hizmet_kategori()
    {
        return view('back.hizmet.hizmet-kategori-listele');
    }

    public function hizmet_kategori_ekle()
    {
        return view('back.hizmet.hizmet-kategori-ekle');
    }

    public function hizmet_kategori_ekle_post()
    {

    }

    public function hizmet_kategori_duzenle()
    {
        return view('back.hizmet.hizmet-kategori-duzenle');
    }

    public function hizmet_kategori_duzenle_post()
    {

    }

    // Hizmet


    // Slider

    public function slider()
    {
        return view('back.slider.slider-listele');
    }

    public function slider_ekle()
    {
        return view('back.slider.slider-ekle');
    }

    public function slider_ekle_post()
    {

    }

    public function slider_duzenle()
    {
        return view('back.slider.slider-duzenle');
    }

    public function slider_duzenle_post()
    {

    }

    // Slider


    // Ürün

    public function urun()
    {
        return view('back.urun.urun-listele');
    }

    public function urun_ekle()
    {
        return view('back.urun.urun-ekle');
    }

    public function urun_ekle_post()
    {

    }

    public function urun_duzenle()
    {
        return view('back.urun.urun-duzenle');
    }

    public function urun_duzenle_post()
    {

    }

    public function urun_kategori()
    {
        return view('back.urun.urun-kategori-listele');
    }

    public function urun_kategori_ekle()
    {
        return view('back.urun.urun-kategori-ekle');
    }

    public function urun_kategori_ekle_post()
    {

    }

    public function urun_kategori_duzenle()
    {
        return view('back.urun.urun-kategori-duzenle');
    }

    public function urun_kategori_duzenle_post()
    {

    }

    // Ürün


    // Üye

    public function uye()
    {
        return view('back.uye.uye-listele');
    }

    public function uye_ekle()
    {
        return view('back.uye.uye-ekle');
    }

    public function uye_ekle_post(Request $request)
    {

    }

    public function uye_duzenle()
    {
        return view('back.uye.uye-duzenle');
    }

    public function uye_duzenle_post()
    {

    }

    // Üye


}
