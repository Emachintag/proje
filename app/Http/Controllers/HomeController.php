<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


function compressImage($source, $destination, $quality,$width)
{
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);


    $kucukresimgenislik = $width;
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


        if(isset($request->site_favicon)) {
            request()->validate([
                'favicon' => 'image'
            ], [
                'favicon.image' => 'Favicon bir resim olmalıdır (Jpg, jpeg, png, ico)',
            ]);
            $info = getimagesize($request->site_favicon);
            $extension = image_type_to_extension($info[2]);
            $imageName = time()."1".$extension;
            $request->site_favicon->move(public_path('img'), $imageName);
            DB::table('site_ayarlar')->where('id', 1)->update(['site_favicon' => $imageName]);
        }
        if(isset($request->site_logo)) {
            request()->validate([
                'logo' => 'image'
            ], [
                'logo.image' => 'Logo bir resim olmalıdır (Jpg, jpeg, png, ico)',
            ]);
            $info = getimagesize($request->site_logo);
            $extension = image_type_to_extension($info[2]);
            $imageName = time()."2".$extension;
            $request->site_logo->move(public_path('img'), $imageName);
            DB::table('site_ayarlar')->where('id', 1)->update(['site_logo' => $imageName]);
        }
        if(isset($request->site_logo_1)) {
            request()->validate([
                'logo' => 'image'
            ], [
                'logo.image' => 'Logo bir resim olmalıdır (Jpg, jpeg, png, ico)',
            ]);
            $info = getimagesize($request->site_logo_1);
            $extension = image_type_to_extension($info[2]);
            $imageName = time()."3".$extension;
            $request->site_logo_1->move(public_path('img'), $imageName);
            DB::table('site_ayarlar')->where('id', 1)->update(['site_logo_1' => $imageName]);
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

    public function hakkimizda_ayarlar()
    {
        return view('back.hakkimizda.hakkimizda');
    }

    public function hakkimizda_ayarlar_post(Request $request)
    {
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);

            DB::table('hakkimizda')->where('id', '1')->update([
                'image' => $imageName,
            ]);
        }
        DB::table('hakkimizda')->where('id', '1')->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'text_2' => $request->input('text_2'),
            'text' => $request->input('text'),
            'updated_at' => date('YmdHis'),

        ]);

        return back()->with('success', 'İletişim bilgileri başarıyla güncellendi.');
    }

    public function tarim_ayarlar()
    {
        return view('back.hakkimizda.tarim');
    }

    public function tarim_ayarlar_post(Request $request)
    {
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);

            DB::table('tarim')->where('id', '1')->update([
                'image' => $imageName,
            ]);
        }
        DB::table('tarim')->where('id', '1')->update([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'text_2' => $request->input('text_2'),


        ]);

        return back()->with('success', 'İletişim bilgileri başarıyla güncellendi.');
    }

    public function sakarya_ayarlar()
    {
        return view('back.hakkimizda.sakarya');
    }

    public function sakaryar_post(Request $request)
    {
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);

            DB::table('sakarya')->where('id', '1')->update([
                'image' => $imageName,
            ]);
        }
        DB::table('sakarya')->where('id', '1')->update([
            'title' => $request->input('title'),
            'text' => $request->input('text'),


        ]);

        return back()->with('success', 'İletişim bilgileri başarıyla güncellendi.');
    }

    public function ekatalog_ayarlar()
    {
        return view('back.ayarlar.ekatalog');
    }

    public function ekatalog_ayarlar_post(Request $request)
    {

        DB::table('ekatalog')->where('id', '1')->update([
            'title' => $request->input('title'),
            'updated_at' => date('YmdHis'),

        ]);
        $lastId = DB::getPdo()->lastInsertId();
        if (isset($request->pdf)) {
            $pdfName = time() . ".pdf";
            $request->pdf->move(public_path('img'), $pdfName);
            DB::table('ekatalog')->where('id', $lastId)->update([
                'pdf' => $pdfName,
            ]);
        }

        return back()->with('success', 'İletişim bilgileri başarıyla güncellendi.');
    }

    public function vizyon_ayarlar()
    {
        return view('back.hakkimizda.vizyon');
    }

    public function vizyon_ayarlar_post(Request $request)
    {
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);

            DB::table('vizyon')->where('id', '1')->update([
                'image' => $imageName,
            ]);
        }
        DB::table('vizyon')->where('id', '1')->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'text_2' => $request->input('text_2'),
            'text' => $request->input('text'),
            'updated_at' => date('YmdHis'),

        ]);

        return back()->with('success', 'İletişim bilgileri başarıyla güncellendi.');
    }

    public function misyon_ayarlar()
    {
        return view('back.hakkimizda.misyon');
    }

    public function misyon_ayarlar_post(Request $request)
    {
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);
            DB::table('misyon')->where('id', '1')->update([
                'image' => $imageName,
            ]);
        }
        DB::table('misyon')->where('id', '1')->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'text_2' => $request->input('text_2'),
            'text' => $request->input('text'),
            'updated_at' => date('YmdHis'),

        ]);

        return back()->with('success', 'İletişim bilgileri başarıyla güncellendi.');
    }



    // Üye Ekleme

    public function uyeler()
    {
        return view('back.uye.uye-listele');
    }

    public function uye_ekle()
    {
        return view('back.uye.uye-ekle');
    }

    public function uye_ekle_post(Request $request)
    {
        $user= new User();
        if (isset($request->image)) {
        $info = getimagesize($request->image);
        $extension = image_type_to_extension($info[2]);
        $imageName = time().$extension;
        $request->image->move(public_path('img'), $imageName);
            $user->image = $imageName;}


        $user->name = $request->name;
        $user->email = $request->email;
        $user->last_name = $request->last_name;
        $user->password=bcrypt(request()->password);

        $user->save();

        return redirect()->route('uyeler')->with('success', 'Yeni üye başarıyla eklendi.');
    }

    public function uye_duzenle()
    {
        return view('back.uye.uye-duzenle');
    }

    public function uye_duzenle_post(Request $request)
    {
        if(isset($request->image)) {

            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);
            DB::table('users')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
        ]);
        if($request->password != '') {
            DB::table('users')->where('id', $request->id)->update([
                'password' => bcrypt(request()->password),
            ]);
        }
        return redirect()->route('uyeler')->with('success', 'Yeni üye başarıyla düzenlendi.');
    }

    // Üye Ekleme


    // Profil Gilgileri Güncelleme

    public function profil()
    {
        return view('back.ayarlar.profil-bilgileri');
    }

    public function profil_post(Request $request)
    {

        if(isset($request->image)) {

            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);
            DB::table('users')->where('id', Auth::user()->id)->update([
                'image' => $imageName,
            ]);
        }

        DB::table('users')->where('id', Auth::user()->id)->update([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
        ]);
        return redirect()->route('home')->with('success', 'Profiliniz başarıyla güncellendi.');
    }

    // Profil Gilgileri Güncelleme

    // Şifre Değiştirme

    public function sifre()
    {
        return view('back.ayarlar.sifre-guncelle');
    }

    public function sifre_post(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6',
            'password2' => 'required|min:6',
        ], [
            'old_password.required' => 'Eski Şifreniz gereklidir.',
            'password.required' => 'Yeni Şifreniz gereklidir.',
            'password2.required' => 'Yeni Şifrenizi tekrar yazmanız gereklidir.',
            'password2.min' => 'Yeni Şifrenizin tekrarı en az 6 karakter olmalıdır.',
            'password.min' => 'Yeni Şifreniz en az 6 karakter olmalıdır.',
        ]);
        if($request->input('password') != $request->input('password2')) {
            $validator->errors()->add('old_password', 'Yeni şifreniz ile yeni şifre tekrarınız uyuşmuyor.');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $password = $request->input('old_password');
        $user = User::where('id', Auth::user()->id)->first();
        if (!Hash::check($password, $user->password) ) {
            $validator->errors()->add('old_password', 'Eski şifreniz ile yeni şifreniz uyuşmuyor. Güvenlik nedeniyle şifrenizi değiştirebilmek için eski şifrenize ihtiyacımız var.');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            DB::table('users')->where('id', Auth::user()->id)->update([
                'password' => bcrypt(request()->password),
            ]);
            return back()->with('success', 'Şifreniz başarıyla kaydedildi');
        }
    }

    // Şifre Değiştirme


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
        $lastId = DB::getPdo()->lastInsertId();
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
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);
            DB::table('belge')->where('id', $lastId)->update([
                'image' => $imageName,
            ]);
        }
        return redirect()->route('belge')->with('success', 'Yeni belge başarıyla eklendi.');

    }

    public function belge_duzenle()
    {
        return view('back.belge.belge-duzenle');
    }

    public function belge_duzenle_post(Request $request)
    {

        if(isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);
            DB::table('belge')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('belge')->where('id', $request->id)->update([
            'title' => $request->input('title'),
            'updated_at' => date('YmdHis'),
        ]);
        if(isset($request->pdf)) {
            $pdfName = time().".pdf";
            $request->pdf->move(public_path('img'), $pdfName);
            DB::table('belge')->where('id', $request->id)->update([
                'pdf' => $pdfName,
            ]);
        }
        return redirect()->route('belge')->with('success', 'Yeni haber başarıyla eklendi.');

    }

    // Belge




    // Galeri

    public function galeri()
    {
        return view('back.galeri.galeri-listele');
    }

    public function galeri_ekle()
    {
        return view('back.galeri.galeri-ekle');
    }

    public function galeri_ekle_post(Request $request)
    {

        DB::table('galeri')->insert([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'link' => $request->input('link'),
            'image' => $request->input('image'),
            'created_at' => date('YmdHis'),

        ]);
        $lastId = DB::getPdo()->lastInsertId();
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);
            DB::table('galeri')->where('id', $lastId)->update([
                'image' => $imageName,
            ]);
        }
        return redirect()->route('galeri')->with('success', 'Yeni ürün başarıyla eklendi.');

    }

    public function galeri_duzenle()
    {
        return view('back.galeri.galeri-duzenle');
    }

    public function galeri_duzenle_post(Request $request)
    {

        if(isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);
            DB::table('galeri')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('galeri')->where('id', $request->id)->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'link' => $request->input('link'),
            'updated_at' => date('YmdHis'),
        ]);

        return redirect()->route('galeri')->with('success', 'Yeni haber başarıyla eklendi.');

    }

    // Galeri




    // Slider

    public function slider()
    {
        return view('back.slider.slider-listele');
    }

    public function slider_ekle()
    {
        return view('back.slider.slider-ekle');
    }

    public function slider_ekle_post(Request $request)
    {

        DB::table('slider')->insert([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'buton' => $request->input('buton'),
            'link' => $request->input('link'),
            'image' => $request->input('image'),
            'created_at' => date('YmdHis'),

        ]);
        $lastId = DB::getPdo()->lastInsertId();
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);
            DB::table('slider')->where('id', $lastId)->update([
                'image' => $imageName,
            ]);
        }
        return redirect()->route('slider')->with('success', 'Yeni ürün başarıyla eklendi.');

    }

    public function slider_duzenle()
    {
        return view('back.slider.slider-duzenle');
    }

    public function slider_duzenle_post(Request $request)
    {

        if(isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);
            DB::table('slider')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('slider')->where('id', $request->id)->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'buton' => $request->input('buton'),
            'link' => $request->input('link'),
            'updated_at' => date('YmdHis'),
        ]);

        return redirect()->route('slider')->with('success', 'Yeni haber başarıyla eklendi.');

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
            'youtube' => $request->input('youtube'),
            'url' => $url,
            'created_at' => date('YmdHis'),
        ]);
        $lastId = DB::getPdo()->lastInsertId();
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
            $imageName = time().$extension;
            $request->image->move(public_path('img'), $imageName);

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
                $imageName = time().$i.$extension;
                $image->move(public_path().'/img/', $imageName);

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
            $request->image->move(public_path('img'), $imageName);
            DB::table('urun')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('urun')->where('id', $request->id)->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'kategori' => $request->input('kategori'),
            'text' => $request->input('text'),
            'youtube' => $request->input('youtube'),
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
                $image->move(public_path().'/img/', $imageName);
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





}
