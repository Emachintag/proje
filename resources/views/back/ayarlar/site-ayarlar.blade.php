@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/vendors/css/editors/tinymce/tinymce.min.css')}}">
@endsection
@extends('back.layouts.app')
@section('content')
    <?php
    $site_ayarlar = DB::table('site_ayarlar')->first();
    ?>
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-body">
                <!-- input groups start -->

                <!-- input groups end -->
                <div class="row">
                    <div class="col-md-12">
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
                                @if($errors->any())
                                    <div class="alert bg-warning alert-icon-left alert-arrow-left alert-dismissible mb-2"
                                         role="alert">
                                        <span class="alert-icon"><i class="ft ft-alert-circle"></i></span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{!! implode('', $errors->all('<div>:message</div>')) !!}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="row-separator-colored-controls">Site Ayarları</h4>
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
                                    <form class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-newspaper-o"></i>Ayarlar</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Site Başlığı</label>
                                                                <div class="input-group">
                                                                    <input value="{{$site_ayarlar->site_name}}" name="site_name" type="text" class="form-control" placeholder="Site Başlığı" aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Site Açıklama</label>
                                                                <div class="input-group">
                                                                    <input value="{{$site_ayarlar->site_description}}" name="site_description" type="text" class="form-control" placeholder="Site Açıklama" aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Footer Text</label>
                                                                <div class="input-group">
                                                                    <input value="{{$site_ayarlar->site_footer_text}}" name="site_footer_text" type="text" class="form-control" placeholder="Footer Text" aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Site Googleda Endekslensin mi</label>
                                                                <div class="input-group">
                                                                    <select name="site_google" class="form-control" id="basicSelect">
                                                                        @if($site_ayarlar->site_google == 1)
                                                                        <option value="1" selected >Evet</option>
                                                                            <option value="0" >Hayır</option>
                                                                        @else
                                                                            <option value="1" >Evet</option>
                                                                            <option value="0" selected >Hayır</option>
                                                                            @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="label-control text-pink" for="userinput15">Logo</label>
                                                        @if($site_ayarlar->site_logo != '')
                                                            <?php
                                                            $image = $site_ayarlar->site_logo;
                                                            ?>
                                                            <div class="row" style="margin-bottom: 3em;">
                                                                <div class="col-md-3">
                                                                    <img class="img-thumbnail" src="{{ asset('/public/img/'.$image.'') }}" alt="{{$site_ayarlar->site_name}} favicon" style="width: 100%;">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <h3>
                                                                        <strong>Not: Logo'yu değiştirmek için yeni resim seçip yükleyebilirsiniz.</strong>
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <input
                                                            id="userinput15"
                                                            class="form-control border-pink @error('meta') is-invalid border-pink @enderror"
                                                            type="file"
                                                            name="site_logo"/>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="label-control text-pink" for="userinput15">Logo</label>
                                                        @if($site_ayarlar->site_logo_1 != '')
                                                            <?php
                                                            $image = $site_ayarlar->site_logo_1;
                                                            ?>
                                                            <div class="row" style="margin-bottom: 3em;">
                                                                <div class="col-md-3">
                                                                    <img class="img-thumbnail" src="{{ asset('/public/img/'.$image.'') }}" alt="{{$site_ayarlar->site_name}} Logo" style="width: 100%;">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <h3>
                                                                        <strong>Not: Siyah Logo'yu değiştirmek için yeni resim seçip yükleyebilirsiniz.</strong>
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <input
                                                            id="userinput15"
                                                            class="form-control border-pink @error('meta') is-invalid border-pink @enderror"
                                                            type="file"
                                                            name="site_logo_1"/>

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="label-control text-pink" for="userinput15">Favicon</label>
                                                        @if($site_ayarlar->site_favicon != '')
                                                            <?php
                                                            $image = $site_ayarlar->site_favicon;
                                                            ?>
                                                            <div class="row" style="margin-bottom: 3em;">
                                                                <div class="col-md-3">
                                                                    <img class="img-thumbnail" src="{{ asset('/public/img/'.$image.'') }}" alt="{{$site_ayarlar->site_name}} favicon" style="width: 100%;">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <h3>
                                                                        <strong>Not: Favicon'u değiştirmek için yeni resim seçip yükleyebilirsiniz.</strong>
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <input
                                                            id="userinput15"
                                                            class="form-control border-pink @error('meta') is-invalid border-pink @enderror"
                                                            type="file"
                                                            name="site_favicon"/>

                                                    </div>
                                                </div>



                                            </div>

                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit" class="btn btn-success btn-min-width btn-glow mr-1 mb-1">Güncelle</button>
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
    <script src="{{asset('/public/back/app-assets/vendors/js/editors/tinymce/tinymce.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/js/scripts/editors/editor-tinymce.js')}}" type="text/javascript"></script>
@endsection
