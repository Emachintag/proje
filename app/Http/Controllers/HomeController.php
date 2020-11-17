<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

function compressImage($source, $destination, $quality)
{
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);


    $kucukresimgenislik = 700;
    $genislik = imagesx($image);
    $yukseklik = imagesy($image);
    $yeni_genislik = $kucukresimgenislik;
    $yeni_yukseklik = (int)round($yukseklik * ($kucukresimgenislik / $genislik));

    $tmp_img = imagecreatetruecolor($yeni_genislik, $yeni_yukseklik);
    imagecopyresized($tmp_img, $image, 0, 0, 0, 0, $yeni_genislik, $yeni_yukseklik, $genislik, $yukseklik);
    imagejpeg($tmp_img, $destination, $quality);
}

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

    public function sosyal_medya_ayarlar_post(Request $request)
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

    public function site_ayarlar_post(Request $request)
    {


        if (isset($request->site_favicon)) {
            $info = getimagesize($request->site_favicon);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            /*
             * Resim Sıkıştırma / Not : $request->input adı ->move() satırını silmelisin resim yükleme sırasında, sıkıştırma resmi yükleyecek
             */
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['site_favicon']['tmp_name'], $location, 75);

            DB::table('site_ayarlar')->where('id', 1)->update(['site_favicon' => $imageName]);
        }
        if (isset($request->site_logo)) {

            $info = getimagesize($request->site_logo);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['site_logo']['tmp_name'], $location, 75);
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

    public function iletisim_ayarlar_post(Request $request)
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

    public function blog_ekle_post(Request $request)
    {

        $url = Str::slug($request->input('title'), '-');
        DB::table('blog')->insert([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'kategori' => $request->input('kategori'),
            'text' => $request->input('text'),
            'url' => $url,
        ]);
        $lastId = DB::table('blog')->get()->last()->id;
        if (isset($request->pdf)) {
            $pdfName = time() . ".pdf";
            $request->pdf->move(public_path('img'), $pdfName);
            DB::table('blog')->where('id', $lastId)->update([
                'pdf' => $pdfName,
            ]);
        }
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

            DB::table('blog')->where('id', $lastId)->update([
                'image' => $imageName,
            ]);
        }
        if ($request->hasfile('pdfs')) {
            $i = 1;
            foreach ($request->file('pdfs') as $image) {
                $extension = $image->getClientOriginalExtension();
                $pdfName = $url . "-" . $i . "-" . $image->getClientOriginalName();
                $pdfFirstName = explode(".", $pdfName);
                $pdfName = Str::slug($pdfFirstName[0], '-');
                $pdfName = $pdfName . "." . $extension;
                $image->move(public_path('img'), $pdfName);
                DB::table('blog_belge')->insert([
                    'blog_id' => $lastId,
                    'belge' => $pdfName,
                ]);
                $i = $i + 1;
            }
        }
        if ($request->hasfile('images')) {
            $i = 0;
            foreach ($request->file('images') as $image) {

                $info = getimagesize($image);
                $extension = image_type_to_extension($info[2]);
                $imageName = time() . $i . $extension;
                $location = public_path('img') . "\ " . $imageName;
                $location = str_replace(' ', '', $location);
                compressImage($_FILES['images']['tmp_name'][$i], $location, 80);

                DB::table('blog_gorsel')->insert([
                    'blog_id' => $lastId,
                    'gorsel' => $imageName,
                ]);
                $i = $i + 1;
            }
        }
        return redirect()->route('blog')->with('success', 'Yeni ürün başarıyla eklendi.');

    }

    public function blog_duzenle()
    {
        return view('back.blog.blog-duzenle');
    }

    public function blog_duzenle_post(Request $request)
    {

        if(isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);
            DB::table('blog')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('blog')->where('id', $request->id)->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'kategori' => $request->input('kategori'),
            'text' => $request->input('text'),
        ]);
        $url = Str::slug($request->input('title'), '-');
        if($request->hasfile('pdf'))
        {
            $i = 1;
            foreach($request->file('pdf') as $image)
            {
                $extension = $image->getClientOriginalExtension();
                $pdfName = $url."-".$i."-".$image->getClientOriginalName();
                $pdfFirstName = explode(".", $pdfName);
                $pdfName = Str::slug($pdfFirstName[0], '-');
                $pdfName = $pdfName.".".$extension;

                $image->move(public_path('img'), $pdfName);
                DB::table('blog_belge')->insert([
                    'blog_id' => $request->id,
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
                $location = public_path('img') . "\ " . $imageName;
                $location = str_replace(' ', '', $location);
                compressImage($_FILES['images']['tmp_name'][$i], $location, 80);
                DB::table('blog_gorsel')->insert([
                    'blog_id' => $request->id,
                    'gorsel' => $imageName,
                ]);
                $i = $i + 1;
            }
        }
        return redirect()->route('blog')->with('success', 'Yeni haber başarıyla eklendi.');

    }

    public function blog_kategori()
    {
        return view('back.blog.blog-kategori-listele');
    }

    public function blog_kategori_ekle()
    {
        return view('back.blog.blog-kategori-ekle');
    }

    public function blog_kategori_ekle_post(Request $request)
    {

        DB::table('blog_kategori')->insert([
            'kategori' => $request->input('kategori'),
            'sira' => $request->input('sira'),
        ]);

        return redirect()->route('blog_kategori')->with('success', 'Yeni Kategori başarıyla eklendi.');

    }

    public function blog_kategori_duzenle()
    {
        return view('back.blog.blog-kategori-duzenle');
    }

    public function blog_kategori_duzenle_post(Request $request)
    {

        DB::table('blog_kategori')->where('id', $request->id)->update([
            'kategori' => $request->input('kategori'),
            'sira' => $request->input('sira'),
        ]);

        return redirect()->route('blog_kategori')->with('success', 'Yeni Kategori başarıyla eklendi.');

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

    public function belge_ekle_post(Request $request)
    {

        DB::table('belge')->insert([
            'title' => $request->input('title'),
            'created_at' => date('YmdHis'),

        ]);
        $lastId = DB::table('belge')->get()->last()->id;
        if (isset($request->pdf)) {
            $pdfName = time() . ".pdf";
            $request->pdf->move(public_path('img'), $pdfName);
            DB::table('belge')->where('id', $lastId)->update([
                'pdf' => $pdfName,
            ]);
        }
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

            DB::table('belge')->where('id', $lastId)->update([
                'image' => $imageName,
            ]);
        }
        return redirect()->route('belge')->with('success', 'Yeni ürün başarıyla eklendi.');

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
        if (isset($request->pdf)) {
            $pdfName = time() . ".pdf";
            $request->pdf->move(public_path('img'), $pdfName);
            DB::table('haber')->where('id', $lastId)->update([
                'pdf' => $pdfName,
            ]);
        }
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

            DB::table('haber')->where('id', $lastId)->update([
                'image' => $imageName,
            ]);
        }
        if ($request->hasfile('pdfs')) {
            $i = 1;
            foreach ($request->file('pdfs') as $image) {
                $extension = $image->getClientOriginalExtension();
                $pdfName = $url . "-" . $i . "-" . $image->getClientOriginalName();
                $pdfFirstName = explode(".", $pdfName);
                $pdfName = Str::slug($pdfFirstName[0], '-');
                $pdfName = $pdfName . "." . $extension;
                $image->move(public_path('img'), $pdfName);
                DB::table('haber_belge')->insert([
                    'haber_id' => $lastId,
                    'belge' => $pdfName,
                ]);
                $i = $i + 1;
            }
        }
        if ($request->hasfile('images')) {
            $i = 0;
            foreach ($request->file('images') as $image) {

                $info = getimagesize($image);
                $extension = image_type_to_extension($info[2]);
                $imageName = time() . $i . $extension;
                $location = public_path('img') . "\ " . $imageName;
                $location = str_replace(' ', '', $location);
                compressImage($_FILES['images']['tmp_name'][$i], $location, 80);

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

    public function haber_duzenle_post(Request $request)
    {

        if(isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);
            DB::table('haber')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('haber')->where('id', $request->id)->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'kategori' => $request->input('kategori'),
            'text' => $request->input('text'),
        ]);
        $url = Str::slug($request->input('title'), '-');
        if($request->hasfile('pdf'))
        {
            $i = 1;
            foreach($request->file('pdf') as $image)
            {
                $extension = $image->getClientOriginalExtension();
                $pdfName = $url."-".$i."-".$image->getClientOriginalName();
                $pdfFirstName = explode(".", $pdfName);
                $pdfName = Str::slug($pdfFirstName[0], '-');
                $pdfName = $pdfName.".".$extension;

                $image->move(public_path('img'), $pdfName);
                DB::table('haber_belge')->insert([
                    'haber_id' => $request->id,
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
                $location = public_path('img') . "\ " . $imageName;
                $location = str_replace(' ', '', $location);
                compressImage($_FILES['images']['tmp_name'][$i], $location, 80);
                DB::table('haber_gorsel')->insert([
                    'haber_id' => $request->id,
                    'gorsel' => $imageName,
                ]);
                $i = $i + 1;
            }
        }
        return redirect()->route('haber')->with('success', 'Yeni haber başarıyla eklendi.');

    }

    public function haber_kategori()
    {
        return view('back.haber.haber-kategori-listele');
    }

    public function haber_kategori_ekle()
    {
        return view('back.haber.haber-kategori-ekle');
    }

    public function haber_kategori_ekle_post(Request $request)
    {

        DB::table('haber_kategori')->insert([
            'kategori' => $request->input('kategori'),
            'sira' => $request->input('sira'),
        ]);

        return redirect()->route('haber_kategori')->with('success', 'Yeni Kategori başarıyla eklendi.');

    }

    public function haber_kategori_duzenle()
    {
        return view('back.haber.haber-kategori-duzenle');
    }

    public function haber_kategori_duzenle_post(Request $request)
    {

        DB::table('haber_kategori')->where('id', $request->id)->update([
            'kategori' => $request->input('kategori'),
            'sira' => $request->input('sira'),
        ]);

        return redirect()->route('haber_kategori')->with('success', 'Yeni Kategori başarıyla eklendi.');

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

    public function hizmet_ekle_post(Request $request)
    {

        $url = Str::slug($request->input('title'), '-');
        DB::table('hizmet')->insert([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'kategori' => $request->input('kategori'),
            'text' => $request->input('text'),
            'url' => $url,
            'created_at' => date('YmdHis'),
        ]);
        $lastId = DB::table('hizmet')->get()->last()->id;
        if (isset($request->pdf)) {
            $pdfName = time() . ".pdf";
            $request->pdf->move(public_path('img'), $pdfName);
            DB::table('hizmet')->where('id', $lastId)->update([
                'pdf' => $pdfName,
            ]);
        }
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

            DB::table('hizmet')->where('id', $lastId)->update([
                'image' => $imageName,
            ]);
        }
        if ($request->hasfile('pdfs')) {
            $i = 1;
            foreach ($request->file('pdfs') as $image) {
                $extension = $image->getClientOriginalExtension();
                $pdfName = $url . "-" . $i . "-" . $image->getClientOriginalName();
                $pdfFirstName = explode(".", $pdfName);
                $pdfName = Str::slug($pdfFirstName[0], '-');
                $pdfName = $pdfName . "." . $extension;
                $image->move(public_path('img'), $pdfName);
                DB::table('hizmet_belge')->insert([
                    'hizmet_id' => $lastId,
                    'belge' => $pdfName,
                ]);
                $i = $i + 1;
            }
        }
        if ($request->hasfile('images')) {
            $i = 0;
            foreach ($request->file('images') as $image) {

                $info = getimagesize($image);
                $extension = image_type_to_extension($info[2]);
                $imageName = time() . $i . $extension;
                $location = public_path('img') . "\ " . $imageName;
                $location = str_replace(' ', '', $location);
                compressImage($_FILES['images']['tmp_name'][$i], $location, 80);

                DB::table('hizmet_gorsel')->insert([
                    'hizmet_id' => $lastId,
                    'gorsel' => $imageName,
                ]);
                $i = $i + 1;
            }
        }
        return redirect()->route('hizmet')->with('success', 'Yeni ürün başarıyla eklendi.');

    }

    public function hizmet_duzenle()
    {
        return view('back.hizmet.hizmet-duzenle');
    }

    public function hizmet_duzenle_post(Request $request)
    {

        if(isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);
            DB::table('hizmet')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('hizmet')->where('id', $request->id)->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'kategori' => $request->input('kategori'),
            'text' => $request->input('text'),
            'updated_at' => date('YmdHis'),
        ]);
        $url = Str::slug($request->input('title'), '-');
        if($request->hasfile('pdf'))
        {
            $i = 1;
            foreach($request->file('pdf') as $image)
            {
                $extension = $image->getClientOriginalExtension();
                $pdfName = $url."-".$i."-".$image->getClientOriginalName();
                $pdfFirstName = explode(".", $pdfName);
                $pdfName = Str::slug($pdfFirstName[0], '-');
                $pdfName = $pdfName.".".$extension;

                $image->move(public_path('img'), $pdfName);
                DB::table('hizmet_belge')->insert([
                    'hizmet_id' => $request->id,
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
                $location = public_path('img') . "\ " . $imageName;
                $location = str_replace(' ', '', $location);
                compressImage($_FILES['images']['tmp_name'][$i], $location, 80);
                DB::table('hizmet_gorsel')->insert([
                    'hizmet_id' => $request->id,
                    'gorsel' => $imageName,
                ]);
                $i = $i + 1;
            }
        }
        return redirect()->route('hizmet')->with('success', 'Yeni haber başarıyla eklendi.');

    }

    public function hizmet_kategori()
    {
        return view('back.hizmet.hizmet-kategori-listele');
    }

    public function hizmet_kategori_ekle()
    {
        return view('back.hizmet.hizmet-kategori-ekle');
    }

    public function hizmet_kategori_ekle_post(Request $request)
    {

        DB::table('hizmet_kategori')->insert([
            'kategori' => $request->input('kategori'),
            'sira' => $request->input('sira'),
        ]);

        return redirect()->route('hizmet_kategori')->with('success', 'Yeni Kategori başarıyla eklendi.');

    }

    public function hizmet_kategori_duzenle()
    {
        return view('back.hizmet.hizmet-kategori-duzenle');
    }

    public function hizmet_kategori_duzenle_post(Request $request)
    {

        DB::table('hizmet_kategori')->where('id', $request->id)->update([
            'kategori' => $request->input('kategori'),
            'sira' => $request->input('sira'),
        ]);

        return redirect()->route('hizmet_kategori')->with('success', 'Kategori başarıyla güncellendi.');

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

    public function urun_ekle_post(Request $request)
    {

        $url = Str::slug($request->input('title'), '-');
        DB::table('urun')->insert([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'kategori' => $request->input('kategori'),
            'text' => $request->input('text'),
            'url' => $url,
            'created_at' => date('YmdHis'),
        ]);
        $lastId = DB::table('urun')->get()->last()->id;
        if (isset($request->pdf)) {
            $pdfName = time() . ".pdf";
            $request->pdf->move(public_path('img'), $pdfName);
            DB::table('urun')->where('id', $lastId)->update([
                'pdf' => $pdfName,
            ]);
        }
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

            DB::table('urun')->where('id', $lastId)->update([
                'image' => $imageName,
            ]);
        }
        if ($request->hasfile('pdfs')) {
            $i = 1;
            foreach ($request->file('pdfs') as $image) {
                $extension = $image->getClientOriginalExtension();
                $pdfName = $url . "-" . $i . "-" . $image->getClientOriginalName();
                $pdfFirstName = explode(".", $pdfName);
                $pdfName = Str::slug($pdfFirstName[0], '-');
                $pdfName = $pdfName . "." . $extension;
                $image->move(public_path('img'), $pdfName);
                DB::table('urun_belge')->insert([
                    'urun_id' => $lastId,
                    'belge' => $pdfName,
                ]);
                $i = $i + 1;
            }
        }
        if ($request->hasfile('images')) {
            $i = 0;
            foreach ($request->file('images') as $image) {

                $info = getimagesize($image);
                $extension = image_type_to_extension($info[2]);
                $imageName = time() . $i . $extension;
                $location = public_path('img') . "\ " . $imageName;
                $location = str_replace(' ', '', $location);
                compressImage($_FILES['images']['tmp_name'][$i], $location, 80);

                DB::table('urun_gorsel')->insert([
                    'urun_id' => $lastId,
                    'gorsel' => $imageName,
                ]);
                $i = $i + 1;
            }
        }
        return redirect()->route('urun')->with('success', 'Yeni Ürün başarıyla eklendi.');

    }

    public function urun_duzenle()
    {
        return view('back.urun.urun-duzenle');
    }

    public function urun_duzenle_post(Request $request)
    {

        if(isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);
            DB::table('urun')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('urun')->where('id', $request->id)->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'kategori' => $request->input('kategori'),
            'text' => $request->input('text'),
            'updated_at' => date('YmdHis'),
        ]);
        $url = Str::slug($request->input('title'), '-');
        if($request->hasfile('pdf'))
        {
            $i = 1;
            foreach($request->file('pdf') as $image)
            {
                $extension = $image->getClientOriginalExtension();
                $pdfName = $url."-".$i."-".$image->getClientOriginalName();
                $pdfFirstName = explode(".", $pdfName);
                $pdfName = Str::slug($pdfFirstName[0], '-');
                $pdfName = $pdfName.".".$extension;

                $image->move(public_path('img'), $pdfName);
                DB::table('urun_belge')->insert([
                    'urun_id' => $request->id,
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
                $location = public_path('img') . "\ " . $imageName;
                $location = str_replace(' ', '', $location);
                compressImage($_FILES['images']['tmp_name'][$i], $location, 80);
                DB::table('urun_gorsel')->insert([
                    'urun_id' => $request->id,
                    'gorsel' => $imageName,
                ]);
                $i = $i + 1;
            }
        }
        return redirect()->route('urun')->with('success', 'Yeni Ürün başarıyla eklendi.');

    }

    public function urun_kategori()
    {
        return view('back.urun.urun-kategori-listele');
    }

    public function urun_kategori_ekle()
    {
        return view('back.urun.urun-kategori-ekle');
    }

    public function urun_kategori_ekle_post(Request $request)
    {

        DB::table('urun_kategori')->insert([
            'kategori' => $request->input('kategori'),
            'sira' => $request->input('sira'),
        ]);

        return redirect()->route('urun_kategori')->with('success', 'Yeni Kategori başarıyla eklendi.');

    }

    public function urun_kategori_duzenle()
    {
        return view('back.urun.urun-kategori-duzenle');
    }

    public function urun_kategori_duzenle_post(Request $request)
    {

        DB::table('urun_kategori')->where('id', $request->id)->update([
            'kategori' => $request->input('kategori'),
            'sira' => $request->input('sira'),
        ]);

        return redirect()->route('urun_kategori')->with('success', 'Kategori başarıyla güncellendi.');

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
