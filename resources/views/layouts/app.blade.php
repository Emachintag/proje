<?php

$settings = DB::table('site_ayarlar')->first();
$iletisim = DB::table('iletisim_ayarlar')->first();
$sosyal = DB::table('sosyal_medya_ayarlar')->first();
date_default_timezone_set('Europe/Istanbul');

class Detect
{
    public static function systemInfo()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform = "Bilinmeyen İşletim sistemi";
        $os_array = array(
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows phone 8/i' => 'Windows Phone 8',
            '/windows phone os 7/i' => 'Windows Phone 7',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile');
        $found = false;
        $device = '';
        foreach ($os_array as $regex => $value) {
            if ($found)
                break;
            else if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
                $device = !preg_match('/(windows|mac|linux|ubuntu)/i', $os_platform)
                    ? 'MOBILE' : (preg_match('/phone/i', $os_platform) ? 'MOBILE' : 'SYSTEM');
            }
        }
        $device = !$device ? 'SYSTEM' : $device;
        return array('os' => $os_platform, 'device' => $device);
    }

    public static function browser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $browser = "Bilinmeyen tarayıcı";

        $browser_array = array('/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i' => 'Handheld Browser');
        $found = false;
        foreach ($browser_array as $regex => $value) {
            if ($found)
                break;
            else if (preg_match($regex, $user_agent, $result)) {
                $browser = $value;
            }
        }
        return $browser;
    }
}

$system = Detect::systemInfo();
$browser = Detect::browser();
$ip = Request::ip();
$page = Request::path();
if ($page == '/') {
    $page = 'anasayfa';
}
$kontrol = DB::table('istatistik')->where('ip', $ip)->whereDay('date', date('d'))->count();
if ($kontrol > 0) {
    DB::table('istatistik')->insert([
        'ip' => $ip,
        'date' => date('YmdHis'),
        'page' => $page,
        'device' => $system['os'],
        'browser' => $browser,
        'ms' => $system['device'],
        'tekil' => 0
    ]);
} else {
    DB::table('istatistik')->insert([
        'ip' => $ip,
        'date' => date('YmdHis'),
        'page' => $page,
        'device' => $system['os'],
        'browser' => $browser,
        'ms' => $system['device'],
        'tekil' => 1
    ]);
}


?>



    <!DOCTYPE html>
    <html lang="zxx">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <title>{{$settings->site_name}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="{{$settings->site_description}}" name="description">
        <link rel="icon" href="{{asset('public/img/'.$settings->site_favicon)}}">
        <link href="{{asset('public/img/'.$settings->site_favicon)}}" rel="apple-touch-icon">
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        @yield('meta')
        <!--[if lt IE 9]>
        <script src="{{asset('/public/front/js/html5shiv.js')}}"></script>
        <![endif]-->
        <!-- CSS Files
        ================================================== -->
        <link id="bootstrap" href="{{asset('/public/front/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link id="bootstrap-grid" href="{{asset('/public/front/css/bootstrap-grid.min.css')}}" rel="stylesheet" type="text/css" />
        <link id="bootstrap-reboot" href="{{asset('/public/front/css/bootstrap-reboot.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/public/front/css/animate.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/public/front/css/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/public/front/css/owl.theme.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/public/front/css/owl.transitions.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/public/front/css/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/public/front/css/jquery.countdown.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/public/front/css/style.css')}}" rel="stylesheet" type="text/css" />
        <!-- color scheme -->
        <link id="colors" href="{{asset('/public/front/css/colors/scheme-01.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/public/front/css/coloring.css')}}" rel="stylesheet" type="text/css" />
        <!-- RS5.0 Stylesheet -->
        <link rel="stylesheet" href="{{asset('/public/front/revolution/css/settings.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('/public/front/revolution/css/layers.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('/public/front/revolution/css/navigation.css')}}" type="text/css">
    </head>

<body>
<div id="wrapper">
    <div id="topbar" class="topbar-noborder">
        <div class="container">
            <div class="topbar-left sm-hide">
                    <span class="topbar-widget tb-social">
                          @if($sosyal->facebook != '')
                        <a href="{{$sosyal->facebook}}"><i class="fa fa-facebook"></i></a>
                        @endif
                              @if($sosyal->twitter != '')
                        <a href="{{$sosyal->twitter}}"><i class="fa fa-twitter"></i></a>
                              @endif
                              @if($sosyal->instagram != '')
                        <a href="{{$sosyal->instagram}}"><i class="fa fa-instagram"></i></a>
                                  @endif
                              @if($sosyal->linkedin != '')
                                  <a href="{{$sosyal->linkedin}}"><i class="fa fa-linkedin"></i></a>
                              @endif
                              @if($sosyal->youtube != '')
                                  <a href="{{$sosyal->youtube}}"><i class="fa fa-youtube"></i></a>
                              @endif
                    </span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- header begin -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="de-flex sm-pt10">
                        <div class="de-flex-col">
                            <!-- logo begin -->
                            <div id="logo">
                                <a href="{{route('anasayfa')}}">
                                    <img alt="" class="logo" src="{{asset('/public/img/'.$settings->site_logo)}}" />
                                    <img alt="" class="logo-2" src="{{asset('/public/img/'.$settings->site_logo)}}" />
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>
                        <div class="de-flex-col header-col-mid">
                            <!-- mainmenu begin -->
                            <ul id="mainmenu">
                                <li><a href="{{route('anasayfa')}}">Anasayfa</a></li>
                                <li><a href="#">Kurumsal</a>
                                    <ul>
                                        <li><a href="{{route('hakkimizda')}}">Hakkımızda</a></li>
                                        <li><a href="{{route('tarim')}}">Tarım Makinaları</a></li>
                                        <li><a href="{{route('misyon')}}">Misyon</a></li>
                                        <li><a href="{{route('vizyon')}}">Vizyon</a></li>
                                        <li><a href="{{route('sakarya')}}">Sakaryamız</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('urunlerimiz')}}">Ürünler</a>
                                    <ul>
                                        @foreach(DB::table('urun')->orderBy('id','desc')->get() as $u)
                                        <li><a href="{{route('urun_detay',$u->url)}}">{{$u->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{route('galeriler')}}">Galeri</a></li>
                                <li><a href="{{route('belgeler')}}">E-Katalog</a></li>
                                <li><a href="{{route('iletisim')}}">İletişim</a></li>
                            </ul>
                            <!-- mainmenu close -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


@yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="widget">
                        <a href="{{route('anasayfa')}}"><img alt="" class="img-fluid mb20" src="{{asset('/public/img/'.$settings->site_logo)}}"></a>
                        <p>{{$settings->site_footer_text}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5 class="id-color mb20">Ürünlerimiz</h5>
                    <ul class="ul-style-2">
                        @foreach(DB::table('urun')->take(5)->orderBy('id','desc')->get() as $u)
                            <li><a href="{{route('urun_detay',$u->url)}}">{{$u->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4">
                    <div class="widget">
                        <h5 class="id-color">İletişim</h5>
                        <address class="s1">
                            <span><i class="id-color fa fa-map-marker fa-lg"></i>{{$iletisim->adres}}</span>
                            @if($iletisim->tel_1 != '')
                                <span><i class="id-color fa fa-phone fa-lg"></i><a href="tel:{{$iletisim->tel_1}}" >{{$iletisim->tel_1}}</a></span>
                            @endif
                            @if($iletisim->tel_2 != '')
                                <span><i class="id-color fa fa-phone fa-lg"></i><a href="tel:{{$iletisim->tel_2}}" >{{$iletisim->tel_2}}</a></span>
                            @endif
                            @if($iletisim->tel_3 != '')
                                <span><i class="id-color fa fa-phone fa-lg"></i><a href="tel:{{$iletisim->tel_3}}" >{{$iletisim->tel_3}}</a></span>
                            @endif
                            @if($iletisim->email != '')
                            <span><i class="id-color fa fa-envelope-o fa-lg"></i><a href="mailto:{{$iletisim->email}}">{{$iletisim->email}}</a></span>
                            @endif
                            @if($iletisim->email_2 != '')
                                <span><i class="id-color fa fa-envelope-o fa-lg"></i><a href="mailto:{{$iletisim->email_2}}">{{$iletisim->email_2}}</a></span>
                            @endif
                        </address>
                        <div class="spacer-10"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="subfooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex">
                            <div class="de-flex-col">
                                &copy; Copyright 2021 - İfeelcode
                            </div>
                            <div class="de-flex-col">
                                <div class="social-icons">


                                        @if($sosyal->facebook != '')
                                    <a href="{{$sosyal->facebook}}"><i class="fa fa-facebook fa-lg"></i></a>
                                        @endif
                                        @if($sosyal->twitter != '')
                                    <a href="{{$sosyal->twitter}}"><i class="fa fa-twitter fa-lg"></i></a>
                                        @endif
                                        @if($sosyal->instagram != '')
                                            <a href="{{$sosyal->instagram}}"><i class="fa fa-instagram fa-lg"></i></a>
                                        @endif
                                        @if($sosyal->linkedin != '')
                                    <a href="{{$sosyal->linkedin}}"><i class="fa fa-linkedin fa-lg"></i></a>
                                        @endif
                                        @if($sosyal->youtube != '')
                                        <a href="{{$sosyal->youtube}}"><i class="fa fa-youtube fa-lg"></i></a>
                                        @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer close -->
    <div id="preloader">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
</div>


<!-- Javascript Files
================================================== -->
<script src="{{asset('/public/front/js/jquery.min.js')}}"></script>
<script src="{{asset('/public/front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/public/front/js/wow.min.js')}}"></script>
<script src="{{asset('/public/front/js/jquery.isotope.min.js')}}"></script>
<script src="{{asset('/public/front/js/easing.js')}}"></script>
<script src="{{asset('/public/front/js/owl.carousel.js')}}"></script>
<script src="{{asset('/public/front/js/validation.js')}}"></script>
<script src="{{asset('/public/front/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('/public/front/js/enquire.min.js')}}"></script>
<script src="{{asset('/public/front/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('/public/front/js/jquery.plugin.js')}}"></script>
<script src="{{asset('/public/front/js/typed.js')}}"></script>
<script src="{{asset('/public/front/js/jquery.countTo.js')}}"></script>
<script src="{{asset('/public/front/js/jquery.countdown.js')}}"></script>
<script src="{{asset('/public/front/js/typed.js')}}"></script>
<script src="{{asset('/public/front/js/designesia.js')}}"></script>
<!-- RS5.0 Core JS Files -->
<script type="text/javascript" src="{{asset('/public/front/revolution/js/jquery.themepunch.tools.min838f.js?rev=5.0')}}"></script>
<script type="text/javascript" src="{{asset('/public/front/revolution/js/jquery.themepunch.revolution.min838f.js?rev=5.0')}}"></script>
<!-- RS5.0 Extensions Files -->
<script type="text/javascript" src="{{asset('/public/front/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/public/front/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/public/front/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/public/front/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/public/front/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/public/front/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/public/front/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/public/front/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script>
    jQuery(document).ready(function() {
        // revolution slider
        jQuery("#slider-revolution").revolution({
            sliderType: "standard",
            sliderLayout: "fullwidth",
            delay: 5000,
            navigation: {
                arrows: {
                    enable: true
                },
                bullets: {
                    enable: true,
                    hide_onmobile: false,
                    style: "hermes",
                    hide_onleave: false,
                    direction: "horizontal",
                    h_align: "center",
                    v_align: "bottom",
                    h_offset: 20,
                    v_offset: 30,
                    space: 5,
                },

            },
            parallax: {
                type: "mouse",
                origo: "slidercenter",
                speed: 2000,
                levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
            },
            responsiveLevels: [1920, 1380, 1240],
            gridwidth: [1200, 1200, 940],
            spinner: "off",
            gridheight: 700,
            disableProgressBar: "on"
        });
    });
    </script>
</body>


</html>
