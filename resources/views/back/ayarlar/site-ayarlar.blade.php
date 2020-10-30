@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/vendors/css/editors/tinymce/tinymce.min.css')}}">
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
                                                                    <input name="site_name" type="text" class="form-control" placeholder="Site Başlığı" aria-describedby="basic-addon3">
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
                                                                    <input name="site_description" type="text" class="form-control" placeholder="Site Açıklama" aria-describedby="basic-addon3">
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
                                                                    <input name="site_footer_text" type="text" class="form-control" placeholder="Footer Text" aria-describedby="basic-addon3">
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
                                                                        <option value="1" >Evet</option>
                                                                        <option value="0" >Hayır</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Logo</label>
                                                                <div class="input-group">
                                                                    <input name="site_logo" type="file" class="form-control" placeholder="Alt Başlık" aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Favicon</label>
                                                                <div class="input-group">
                                                                    <input name="site_favicon" type="file" class="form-control" placeholder="Alt Başlık" aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
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
