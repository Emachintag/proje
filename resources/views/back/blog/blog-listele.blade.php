@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
@extends('back.layouts.app')
@section('content')
    <?php
    if(isset($_GET['haber']) AND isset($_GET['sil']) AND isset($_GET['token'])) {
        $haber_id = $_GET['haber'];
        $token = $_GET['token'];
        if(Session::token() == $token) {
            DB::table('blog')->where('id', $haber_id)->delete();
            header("Location: haberler?okey");
            die();
        } else {
            header("Location: haberler?notOkey");
        }
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
                                            <h4 class="text-white">Blog Sayısı</h4>
                                            <span>Yazdığınız Blog Sayısı</span>
                                        </div>
                                        <div class="media-right p-2 media-middle">
                                            <h1 class="text-white">{{DB::table('blog')->count()}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div style="cursor: pointer" onclick="location.href='{{route('blog_ekle')}}'" class="card-content">
                                    <div class="media align-items-stretch bg-gradient-x-info text-white rounded">
                                        <div class="p-2 media-middle">
                                            <i class="icon-pencil font-large-2 text-white"></i>
                                        </div>
                                        <div class="media-body p-2">
                                            <h4 class="text-white">Yeni Blog Ekle</h4>
                                            <span>Yeni Blog İçin Tıklayınız</span>
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
                                    <h4 class="card-title">Blog Listeleme</h4>
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
                                                <th>Blog Başlık</th>
                                                <th>Blog Açıklama</th>
                                                <th>Blog Resim</th>
                                                <th>İşlem</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(DB::table('blog')->get() as $u)
                                            <tr>
                                                <td style="text-align: center" >{{$u->title}}</td>
                                                <td style="text-align: center" >{{$u->title_2}}</td>
                                                <td style="text-align: center" ><img class="img" src="{{asset('/public/img/'.$u->image)}}" height="100"></td>
                                                <td style="text-align: center" >
                                                    <a  href="?haber=&sil&token={{ csrf_token() }}" class="btn btn-danger btn-min-width btn-glow">
                                                        <i class="la la-trash"></i>
                                                        <span>
                                                Sil
                                            </span>
                                                    </a>
                                                    <a href="{{route('blog_duzenle', ['id'=>$u->id])}}" class="btn btn-info btn-min-width btn-glow">
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
                                                <th>Blog Başlık</th>
                                                <th>Blog Açıklama</th>
                                                <th>Blog Resim</th>
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
