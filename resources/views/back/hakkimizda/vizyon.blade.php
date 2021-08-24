@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/vendors/css/editors/tinymce/tinymce.min.css')}}">
@endsection
@extends('back.layouts.app')
@section('content')
    <?php
    $vizyon = DB::table('vizyon')->first();
    ?>
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-body">
                <!-- input groups start -->

                <!-- input groups end -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="row-separator-colored-controls">Vizyon Ekle</h4>
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
                                            <h4 class="form-section"><i class="la la-newspaper-o"></i>Vizyon</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Vizyon Başlığı</label>
                                                                <div class="input-group">
                                                                    <input value="{{$vizyon->title}}" name="title" type="text" class="form-control" placeholder="Başlık" aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <label>Vizyon Görsel (Tek
                                                        Fotoğraf)</label>
                                                    <div class="input-group">
                                                        <input name="image" type="file"
                                                               class="form-control"
                                                               placeholder="Alt Başlık"
                                                               aria-describedby="basic-addon3">
                                                    </div>
                                                    @if($vizyon->image != '')
                                                        <br>
                                                        <div class="input-group">
                                                            <img
                                                                src="{{asset('public/img/'.$vizyon->image)}}"
                                                                class="form-control">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Vizyon Metni (Kısa Anasayfa İçin)</label>
                                                                <div class="form-group">
                                                                    <textarea name="text_2" class="tinymce">{{$vizyon->text_2}} </textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Vizyon Metni</label>
                                                                <div class="form-group">
                                                                    <textarea name="text" class="tinymce">{{$vizyon->text}} </textarea>
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
