<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

    public function hakkimizda_ayarlar()
    {
        return view('back.hakkimizda.hakkimizda');
    }

    public function hakkimizda_ayarlar_post(Request $request)
    {
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

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
        $lastId = DB::table('ekatalog')->get()->last()->id;
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
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

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
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

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
            'created_at' => date('YmdHis'),
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

        $info = getimagesize($request->image);
        $extension = image_type_to_extension($info[2]);
        $imageName = time().$extension;
        $request->image->move(public_path('img'), $imageName);

        $user= new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->last_name = $request->last_name;
        $user->password=bcrypt(request()->password);
        $user->image = $imageName;
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
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);
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
        $lastId = DB::table('galeri')->get()->last()->id;
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

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
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);
            DB::table('belge')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('belge')->where('id', $request->id)->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'link' => $request->input('link'),
            'updated_at' => date('YmdHis'),
        ]);

        return redirect()->route('galeri')->with('success', 'Yeni haber başarıyla eklendi.');

    }

    // Galeri



    // Ekip

    public function ekip()
    {
        return view('back.ekip.ekip-listele');
    }

    public function ekip_ekle()
    {
        return view('back.ekip.ekip-ekle');
    }

    public function ekip_ekle_post(Request $request)
    {

        DB::table('ekip')->insert([
            'isim' => $request->input('isim'),
            'unvan' => $request->input('unvan'),
            'email' => $request->input('email'),
            'image' => $request->input('image'),
            'created_at' => date('YmdHis'),

        ]);
        $lastId = DB::table('ekip')->get()->last()->id;
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

            DB::table('ekip')->where('id', $lastId)->update([
                'image' => $imageName,
            ]);
        }
        return redirect()->route('ekip')->with('success', 'Yeni ürün başarıyla eklendi.');

    }

    public function ekip_duzenle()
    {
        return view('back.ekip.ekip-duzenle');
    }

    public function ekip_duzenle_post(Request $request)
    {

        if(isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time().$extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);
            DB::table('ekip')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('ekip')->where('id', $request->id)->update([
            'isim' => $request->input('isim'),
            'unvan' => $request->input('unvan'),
            'email' => $request->input('email'),
            'updated_at' => date('YmdHis'),
        ]);

        return redirect()->route('ekip')->with('success', 'Yeni haber başarıyla eklendi.');

    }

    // Ekip


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

    public function slider_ekle_post(Request $request)
    {

        DB::table('slider')->insert([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
            'image' => $request->input('image'),
            'created_at' => date('YmdHis'),

        ]);
        $lastId = DB::table('slider')->get()->last()->id;
        if (isset($request->image)) {
            $info = getimagesize($request->image);
            $extension = image_type_to_extension($info[2]);
            $imageName = time() . $extension;
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);

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
            $location = public_path('img') . "\ " . $imageName;
            $location = str_replace(' ', '', $location);
            compressImage($_FILES['image']['tmp_name'], $location, 80);
            DB::table('slider')->where('id', $request->id)->update([
                'image' => $imageName,
            ]);
        }
        DB::table('slider')->where('id', $request->id)->update([
            'title' => $request->input('title'),
            'title_2' => $request->input('title_2'),
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





}
