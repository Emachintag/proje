<!DOCTYPE html>
<html class="loading" lang="tr" data-textdirection="ltr">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <?php $settings = DB::table('settings')->first(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Sizi iyi hissettirecek dijital çözümler için {{$settings->siteName}} yanınızda.">
    <meta name="author" content="{{$settings->siteName}}">
    <title>Giriş Yap | {{$settings->siteName}}</title>
    <link rel="apple-touch-icon" href="{{asset('public/back/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/back/favicon.png')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/back/app-assets/css/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/back/app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/back/app-assets/vendors/css/forms/icheck/custom.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/back/app-assets/css/app.css')}}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/app-assets/css/core/menu/menu-types/vertical-compact-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/back/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/back/app-assets/css/pages/login-register.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/back/assets/css/style.css')}}">
    <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-compact-menu 1-column bg-full-screen-image menu-expanded blank-page blank-page"
      data-open="click" data-menu="vertical-compact-menu" data-col="1-column">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 box-shadow-2 p-0" style="border-radius: 10px;">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0" style="border-radius: 15px;">
                            <div class="card-header border-0">
                                <div class="card-title text-center" style="margin-right: auto; margin-left: auto">
                                    <img src="{{asset('/public/back/logo_beyaz.png')}}" width="200" height="52"
                                         alt="I Feel Code Logo">
                                </div>
                            </div>
                            <div class="card-content">
                                <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                    <span>Oturum Aç</span>
                                </p>
                                <div class="card-body">
                                    <form class="form-horizontal" method="post">
                                        @csrf
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input style="border-radius: 10px;" type="text"
                                                   class="form-control @error('email') is-invalid @enderror" id="email"
                                                   name="email" placeholder="E-postanız" value="{{ old('email') }}"
                                                   required autocomplete="email" autofocus>
                                            <div class="form-control-position">
                                                <i class="ft-mail"></i>
                                            </div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input style="border-radius: 10px;" type="password"
                                                   class="form-control @error('password') is-invalid @enderror <?php if (Session::get('password1')) {
                                                       echo "is-invalid";
                                                   } ?>" id="password" name="password" placeholder="Şifreniz" required
                                                   autocomplete="current-password">
                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                            <?php if(Session::get('password1')) { ?>
                                            <span class="invalid-feedback" role="alert">
                                        <strong>Şifreniz girilen e-posta ile uyuşmuyor!</strong>
                                </span>
                                            <?php } ?>
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-12 text-center text-sm-left">
                                                <fieldset>
                                                    <input type="checkbox" name="remember" id="remember-me"
                                                           class="chk-remember form-control" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="remember-me"> Beni Hatırla</label>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a
                                                    href="/sifremi-unuttum" class="card-link">Şifremi Unuttum</a></div>
                                        </div>
                                        <button style="border-radius: 10px;" type="submit"
                                                class="btn btn-outline-pink btn-block"><i class="ft-unlock"></i> Giriş
                                            Yap
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<!-- BEGIN VENDOR JS-->
<script src="{{asset('public/back/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('public/back/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"
        type="text/javascript"></script>
<script src="{{asset('public/back/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('public/back/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('public/back/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('public/back/app-assets/js/scripts/forms/form-login-register.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
</body>
</html>
