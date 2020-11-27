@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/vendors/css/editors/tinymce/tinymce.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/css/plugins/forms/validation/form-validation.css')}}">
@endsection
@extends('back.layouts.app')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-body">
                <!-- input groups start -->

                <!-- input groups end -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="row-separator-colored-controls"> Hoşgeldiniz <strong>{{Auth::user()->name}} {{Auth::user()->last_name}}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (session('success'))
                                                <div class="alert bg-success alert-icon-left alert-arrow-left alert-dismissible mb-2"
                                                     role="alert">
                                                    <span class="alert-icon"><i class="ft ft-thumbs-up"></i></span>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <strong>{{ session('success') }}</strong>
                                                </div>
                                            @endif
                                            @if ($errors->any())
                                                <div class="alert bg-pink alert-icon-left alert-arrow-left alert-dismissible mb-2"
                                                     role="alert">
                                                    <span class="alert-icon"><i class="ft ft-thumbs-up"></i></span>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <strong>
                                                        @foreach ($errors->all() as $error)
                                                            {{ $error }}
                                                            <br>
                                                        @endforeach
                                                    </strong>
                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                    <form class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-newspaper-o"></i>Şifre Güncelle </h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>Eski şifreniz <span class="required">*</span> </h5>
                                                            <div class="controls">
                                                                <input type="password" name="old_password" class="form-control" required autocomplete="password" data-validation-required-message="Yeni şifre alabilmek için eski şifrenizi girin!">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>Yeni şifreniz <span class="required">*</span> </h5>
                                                            <div class="controls">
                                                                <input type="password" name="password" class="form-control" required autocomplete="new-password" data-validation-required-message="Bu alan gereklidir!">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>Yeni şifrenizi tekrarlayın
                                                                <span class="required">*</span>
                                                            </h5>
                                                            <div class="controls">
                                                                <input type="password" name="password2" data-validation-match-match="password" class="form-control" required data-validation-required-message="Bu alan gereklidir!">
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit" class="btn btn-success btn-min-width btn-glow mr-1 mb-1">Gönder</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')

    <script src="{{asset('/public/back/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/js/scripts/forms/validation/form-validation.js')}}"
            type="text/javascript"></script>

    <script src="{{asset('/public/back/app-assets/vendors/js/editors/tinymce/tinymce.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/js/scripts/editors/editor-tinymce.js')}}" type="text/javascript"></script>
@endsection
