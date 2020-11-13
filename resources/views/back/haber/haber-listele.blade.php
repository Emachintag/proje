<?php
use Illuminate\Support\Facades\File;
?>
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
@extends('back.layouts.app')
@section('content')
    <?php
    if(isset($_GET['id']) AND isset($_GET['sil']) ) {
        $id = $_GET['id'];
        /*
         * Silme işlemi için en üstte bulunan use file ve çekilen tablolar ayarlanmalıdır.
         */

        // tekli görsel silme
        $kapakFoto = DB::table('haber')->where('id', $id)->first()->image;
        $kapakFoto = public_path("img/".$kapakFoto);
        if(File::exists($kapakFoto)) {
            File::delete($kapakFoto);
        }

        // tekli pdf silme
        $kapakPdf = DB::table('haber')->where('id', $id)->first()->pdf;
        $kapakPdf = public_path("img/".$kapakPdf);
        if(File::exists($kapakPdf)) {
            File::delete($kapakPdf);
        }

        // çoklu görsel silme
        foreach (DB::table('haber_gorsel')->where('haber_id', $id)->get() as $u) {
            $gorsel = public_path("img/".$u->gorsel);
            if(File::exists($gorsel)) {
                File::delete($gorsel);
            }
        }

        // çoklu pdf silme
        foreach (DB::table('haber_belge')->where('haber_id', $id)->get() as $u) {
            $belge = public_path("img/".$u->belge);
            if(File::exists($belge)) {
                File::delete($belge);
            }
        }

        //veritabanından silme, not : bunu direkt delete() değil de tabloda deleted_at diye bir alan açalım, silinme tarihini bu alana datetime olarak yazdıralım.
        //yanlışlıkla silinme olursa geri getirebiliriz.
        DB::table('haber')->where('id', $id)->delete();
        header("Location: ?okey");
        die();
    }
    ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">

                <section id="stats-icon-subtitle-bg">
                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="media align-items-stretch bg-gradient-x-warning text-white rounded">
                                        <div class="p-2 media-middle">
                                            <i class="icon-speech font-large-2 text-white"></i>
                                        </div>
                                        <div class="media-body p-2">
                                            <h4 class="text-white">Haber Sayısı</h4>
                                            <span>Yazdığınız Haber Sayısı</span>
                                        </div>
                                        <div class="media-right p-2 media-middle">
                                            <h1 class="text-white">{{DB::table('haber')->count()}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div style="cursor: pointer" onclick="location.href='{{route('haber_ekle')}}'" class="card-content">
                                    <div class="media align-items-stretch bg-gradient-x-info text-white rounded">
                                        <div class="p-2 media-middle">
                                            <i class="icon-pencil font-large-2 text-white"></i>
                                        </div>
                                        <div class="media-body p-2">
                                            <h4 class="text-white">Yeni Haber Ekle</h4>
                                            <span>Yeni Haber İçin Tıklayınız</span>
                                        </div>
                                        <div class="media-right p-2 media-middle">
                                            <h1 class="text-white">18,000</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Haber Listeleme</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                                    <div class="card-body card-dashboard">

                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>Haber Başlık</th>
                                                <th>Haber Açıklama</th>
                                                <th>Haber Resim</th>
                                                <th>İşlem</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(DB::table('haber')->get() as $u)
                                            <tr>
                                                <td style="text-align: center" >{{$u->title}}</td>
                                                <td style="text-align: center" >{{$u->title_2}}</td>
                                                <td style="text-align: center" ><img class="img" src="{{asset('/public/img/'.$u->image)}}" height="100"></td>
                                                <td style="text-align: center" >
                                                    <a href="?id={{$u->id}}&sil" class="btn btn-danger btn-min-width btn-glow">
                                                        <i class="la la-trash"></i>
                                                        <span>
                                                Sil
                                            </span>
                                                    </a>
                                                    <a href="{{route('haber_duzenle', ['id'=>$u->id])}}" class="btn btn-info btn-min-width btn-glow">
                                                        <i class="la la-edit"></i>
                                                        <span>
                                                Düzenle
                                            </span>
                                                    </a>
                                                </td>

                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Haber Başlık</th>
                                                <th>Haber Açıklama</th>
                                                <th>Haber Resim</th>
                                                <th>İşlem</th>

                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->

            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="{{asset('/public/back/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}" type="text/javascript"></script>
@endsection
