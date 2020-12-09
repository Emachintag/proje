<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
          content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard sales - Modern Admin - Clean Bootstrap 4 Dashboard HTML Template + Bitcoin
        Dashboard
    </title>
    <link rel="apple-touch-icon" href="{{asset('/public/favicon.ico')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/public/favicon.ico')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/css/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/css/app.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/back/app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/back/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/back/app-assets/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/back/app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/back/app-assets/css/plugins/extensions/toastr.css')}}">
    <script src="{{asset('/public/back/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/vendors/js/extensions/sweetalert.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/js/scripts/extensions/sweet-alerts.js')}}"
            type="text/javascript"></script>
    @yield('css')

</head>
<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="hover"
      data-menu="horizontal-menu" data-col="2-columns">
<!-- fixed-top-->
<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{route('home')}}">
                        <img class="brand-logo" alt="modern admin logo" src="{{asset('/public/logo.png')}}">
                        <h3 class="brand-text">I Feel Code</h3>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                            class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                              href="#"><i class="ft-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Merhaba,
                  <span class="user-name text-bold-700">{{Auth::user()->name}}</span>
                </span>
                            <span class="avatar avatar-online">
                  <img src="{{asset('public/img/'.Auth::user()->image)}}"
                       alt="avatar"><i></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('profil')}}"><i
                                    class="ft-user"></i> Profil Güncelle</a>
                            <a class="dropdown-item" href="{{route('sifre')}}"><i
                                    class="ft-user-check"></i> Şifre Güncelle</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('cikis')}}"><i class="ft-power"></i> Çıkış Yap</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-without-dd-arrow navbar-light"
     role="navigation" data-menu="menu-wrapper">
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class=" nav-link" href="{{route('home')}}"><i class="la la-home"></i>
                    <span>Anasayfa</span>
                </a>

            </li>
            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                  data-toggle="dropdown"><i
                        class="la la-cogs"></i><span>Site Ayarları</span></a>
                <ul class="dropdown-menu">
                    <li data-menu=""><a class="dropdown-item" href="{{route('site_ayarlar')}}" data-toggle="dropdown">Site
                            Bilgileri</a>
                    </li>
                    <li data-menu=""><a class="dropdown-item" href="{{route('sosyal_medya_ayarlar')}}"
                                        data-toggle="dropdown">Sosyal Medya Bilgileri</a>
                    </li>
                    <li data-menu=""><a class="dropdown-item" href="{{route('iletisim_ayarlar')}}"
                                        data-toggle="dropdown">İletişim Bilgileri</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                  data-toggle="dropdown"><i
                        class="la la-television"></i><span>Modüller</span></a>
                <ul class="dropdown-menu">

                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                class="la la-newspaper-o"></i>Haber Yönetimi</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{route('haber')}}" data-toggle="dropdown">Haber
                                    Görüntüle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('haber_ekle')}}"
                                                data-toggle="dropdown">Haber Ekle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('haber_kategori')}}"
                                                data-toggle="dropdown">Haber Kategori Yönet</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('haber_kategori_ekle')}}"
                                                data-toggle="dropdown">Haber Kategori Ekle</a>
                            </li>

                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                class="la la-newspaper-o"></i>Blog Yönetimi</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{route('blog')}}" data-toggle="dropdown">Blog
                                    Görüntüle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('blog_ekle')}}"
                                                data-toggle="dropdown">Blog Ekle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('blog_kategori')}}"
                                                data-toggle="dropdown">Blog Kategori Yönet</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('blog_kategori_ekle')}}"
                                                data-toggle="dropdown">Blog Kategori Ekle</a>
                            </li>

                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                class="la la-recycle"></i>Hizmet Yönetimi</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{route('hizmet')}}" data-toggle="dropdown">Hizmet
                                    Görüntüle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('hizmet_ekle')}}"
                                                data-toggle="dropdown">Hizmet Ekle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('hizmet_kategori')}}"
                                                data-toggle="dropdown">Hizmet Kategori Yönet</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('hizmet_kategori_ekle')}}"
                                                data-toggle="dropdown">Hizmet Kategori Ekle</a>
                            </li>

                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                class="la la-user-secret"></i>Ekip Yönetimi</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{route('ekip')}}" data-toggle="dropdown">Ekip
                                    Görüntüle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('ekip_ekle')}}"
                                                data-toggle="dropdown">Ekip Ekle</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                class="la la-file-pdf-o"></i>Belge Yönetimi</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{route('belge')}}" data-toggle="dropdown">Belge
                                    Görüntüle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('belge_ekle')}}"
                                                data-toggle="dropdown">Belge Ekle</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                class="la la-photo"></i>Galeri Yönetimi</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{route('galeri')}}" data-toggle="dropdown">Galeri
                                    Görüntüle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('galeri_ekle')}}"
                                                data-toggle="dropdown">Galeri Ekle</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                class="la la-forward"></i>Slider Yönetimi</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{route('slider')}}" data-toggle="dropdown">Slider
                                    Görüntüle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('slider_ekle')}}"
                                                data-toggle="dropdown">Slider Ekle</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                class="la la-paste"></i>Ürün Yönetimi</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{route('urun')}}" data-toggle="dropdown">Ürünleri
                                    Görüntüle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('urun_ekle')}}"
                                                data-toggle="dropdown">Ürün Ekle</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('urun_kategori')}}"
                                                data-toggle="dropdown">Ürün Kategori Yönet</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('urun_kategori_ekle')}}"
                                                data-toggle="dropdown">Ürün Kategori Ekle</a>
                            </li>

                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                class="la la-info-circle"></i>Hakkımızda</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{route('hakkimizda_ayarlar')}}"
                                                data-toggle="dropdown">Hakkımızda Yazısı</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('misyon_ayarlar')}}"
                                                data-toggle="dropdown">Misyon Yazısı</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="{{route('vizyon_ayarlar')}}"
                                                data-toggle="dropdown">Vizyon Yazısı</a>
                            </li>
                        </ul>
                    </li>
                    <li data-menu=""><a class="dropdown-item" href="{{route('ekatalog_ayarlar')}}"
                                        data-toggle="dropdown"><i class="la la-book"></i>E-Katalog</a>
                    </li>

                </ul>

            </li>


            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                  data-toggle="dropdown"><i
                        class="la la-user"></i><span>Üye İşlemleri</span></a>
                <ul class="dropdown-menu">
                    <li data-menu=""><a class="dropdown-item" href="{{route('uyeler')}}" data-toggle="dropdown"><i
                                class="la la-users"></i>Üye Görüntüle</a>
                    </li>
                    <li data-menu=""><a class="dropdown-item" href="{{route('uye_ekle')}}" data-toggle="dropdown"><i
                                class="la la-user-plus"></i>Üye Ekle </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown">
                <a class=" nav-link" href="{{route('anasayfa')}}"><i class="la la-home"></i>
                    <span>Site Anasayfa</span>
                </a>

            </li>


                </ul>
            </li>
        </ul>
    </div>
</div>
@yield('content')

<footer class="footer footer-static footer-light navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright © 2020. <a class="text-bold-800 grey darken-2"
                                                                                   href="http://ifeelcode.com/"
                                                                                   target="_blank">ifeelcode </a>, Her Hakkı Saklıdır. </span>

    </p>
</footer>
<script src="{{asset('/public/back/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/public/back/app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
<script src="{{asset('/public/back/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/back/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/back/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/back/app-assets/vendors/js/extensions/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/back/app-assets/js/scripts/extensions/toastr.js')}}" type="text/javascript"></script>

@yield('js')
</body>
</html>

