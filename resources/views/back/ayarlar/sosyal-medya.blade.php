@extends('back.layouts.app')
@section('content')
    <?php
    $sosyal_medya_ayarlar = DB::table('sosyal_medya_ayarlar')->first();
    ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
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
                                <h4 class="card-title" id="row-separator-colored-controls">Sosyal Medya Ayarları</h4>
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
                                            <h4 class="form-section"><i class="la la-eye"></i>Sosyal Medya</h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <fieldset>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon3"><i class="la la-facebook"></i></span>
                                                                        </div>
                                                                        <input value="{{$sosyal_medya_ayarlar->facebook}}" name="facebook" type="text" class="form-control" placeholder="Facebook" aria-describedby="basic-addon3">
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <fieldset>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon3"><i class="la la-twitter"></i></span>
                                                                        </div>
                                                                        <input value="{{$sosyal_medya_ayarlar->twitter}}" name="twitter" type="text" class="form-control" placeholder="Twitter" aria-describedby="basic-addon3">
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <fieldset>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon3"><i class="la la-instagram"></i></span>
                                                                        </div>
                                                                        <input value="{{$sosyal_medya_ayarlar->instagram}}" name="instagram" type="text" class="form-control" placeholder="İnstagram" aria-describedby="basic-addon3">
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <fieldset>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon3"><i class="la la-youtube-play"></i></span>
                                                                        </div>
                                                                        <input value="{{$sosyal_medya_ayarlar->youtube}}" name="youtube" type="text" class="form-control" placeholder="Youtube" aria-describedby="basic-addon3">
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card-body">
                                                        <div class="card-block">
                                                            <fieldset>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon3"><i class="la la-linkedin"></i></span>
                                                                    </div>
                                                                    <input value="{{$sosyal_medya_ayarlar->linkedin}}" name="linkedin" type="text" class="form-control" placeholder="Linkedin" aria-describedby="basic-addon3">
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check"></i> Güncelle
                                            </button>
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
