<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Redirect;
use App\User;
use Hash;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;


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

    public function galeri()
    {
        return view('galeri');
    }

    public function vizyon()
    {
        return view('vizyon');
    }

    public function misyon()
    {
        return view('misyon');
    }

    public function belgeler()
    {
        return view('belgeler');
    }

    public function ekibimiz()
    {
        return view('ekibimiz');
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

    public function hizmetler()
    {
        return view ('hizmetler');
    }

    public function hizmet($hizmet) {
        return view('hizmet')->with('id', $hizmet);
    }

    public function iletisim_post (Request $request)
    {
        $request = Request::only('ad', 'soyad', 'tel', 'cv', 'email', 'is');
        $request[0] = $request;
        $request = (object) $request;
        $created_at = date('YmdHis');
        $extension = $request->cv->getClientOriginalExtension();
        $cv_name = time() . '.' . $extension;
        $request->cv->move(public_path('img'), $cv_name);
        DB::table('basvurular')->insert([
            'ad' => $request->ad,
            'soyad' => $request->soyad,
            'tel' => $request->tel,
            'email' => $request->email,
            'hangi_is' => $request->is,
            'created_at' => $created_at,
            'cv' => $cv_name,
        ]);


        /*
         * kullanıcıya e-posta
         */
        $to_name = "".$request->ad." ".$request->soyad;
        $to_email = $request->email;
        $data = array('name'=>"İş Başvurusu", 'email'=>$request->email);
        Mail::send('emails.basvuru', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('İş Başvurunuz');
            $message->from('epostaburaya@gmail.com','İş Başvurunuz');
        });


        /*
         * yönetime e-posta
         */
        $to_name = "Şirinat petrol";
        $to_email = "info@sirinatpetrol.com";
        $data = array('name'=>"İş Başvurusu", 'ad'=> $request->ad, 'soyad' => $request->soyad, 'email' => $request->email, 'tel' => $request->tel, 'cv' => $cv_name, "tarih" => $created_at);
        Mail::send('emails.basvuru-yonetim', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('İş Başvurunuz');
            $message->from('epostaburaya@gmail.com','İş Başvurunuz');
        });
        return redirect('insan-kaynaklari')->with('success','Başvurunuz başarıyla alındı. Teşekkür ederiz.');
    }
}
