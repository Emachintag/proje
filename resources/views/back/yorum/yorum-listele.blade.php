@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
@extends('back.layouts.app')
@section('content')
    <?php
    if (isset($_GET['id']) AND isset($_GET['sil'])) {
        $id = $_GET['id'];
        // tekli görsel silme
        $kapakFoto = DB::table('yorum')->where('id', $id)->first()->image;
        $kapakFoto = public_path("img/" . $kapakFoto);
        if (File::exists($kapakFoto)) {
            File::delete($kapakFoto);
        }
        DB::table('yorum')->where('id', $id)->delete();
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
                                    <div class="media align-items-stretch bg-warning text-white rounded">
                                        <div class="bg-warning bg-darken-2 p-2 media-middle">
                                            <i class="icon-speech font-large-2 text-white"></i>
                                        </div>
                                        <div class="media-body p-2">
                                            <h4 class="text-white">Yorum Sayısı</h4>
                                            <span>Eklenen Yorum Sayısı</span>
                                        </div>
                                        <div class="media-right p-2 media-middle">
                                            <h1 class="text-white">{{DB::table('yorum')->count()}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div style="cursor: pointer" onclick="location.href='{{route('yorum_ekle')}}'" class="card-content">
                                    <div class="media align-items-stretch bg-info text-white rounded">
                                        <div class="bg-info bg-darken-2 p-2 media-middle">
                                            <i class="icon-pencil font-large-2 text-white"></i>
                                        </div>
                                        <div class="media-body p-2">
                                            <h4 class="text-white">Yeni Yorum Ekle</h4>
                                            <span>Yeni Yorum İçin Tıklayınız</span>
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
                                    <h4 class="card-title">Yorum Listeleme</h4>
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
                                                <th>İsim Soyisim</th>
                                                <th>Ünvan</th>
                                                <th>Fotoğraf</th>
                                                <th>İşlem</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(DB::table('yorum')->get() as $u)
                                                <tr>
                                                    <td>{{$u->isim}}</td>
                                                    <td>{{$u->unvan}}</td>
                                                    <td style="text-align: center"><img class="img" src="{{asset('/public/img/'.$u->image)}}" height="100"></td>
                                                    <td style="text-align: center">
                                                        <button id="delete-confir{{$u->id}}" class="btn btn-outline-danger">
                                                            <i class="la la-remove"></i>
                                                            Sil
                                                        </button>
                                                        <script>
                                                            $(document).ready(function(){
                                                                $('#delete-confir{{$u->id}}').on('click',function(){
                                                                    swal({
                                                                        title: "Yorum Silme",
                                                                        text: "{{$u->isim}} - yazı tamamen silinecektir. Onaylıyor musunuz?",
                                                                        icon: "warning",
                                                                        buttons: {
                                                                            cancel: {
                                                                                text: "Hayır",
                                                                                value: null,
                                                                                visible: true,
                                                                                className: "btn-outline-success",
                                                                                closeModal: false,
                                                                            },
                                                                            confirm: {
                                                                                text: "Evet",
                                                                                value: true,
                                                                                visible: true,
                                                                                className: "btn-outline-danger",
                                                                                closeModal: false
                                                                            }
                                                                        }
                                                                    }).then(isConfirm => {
                                                                        if (isConfirm) {
                                                                            swal("Başarılı", "Silme işlemi başarılı", "success");
                                                                            location.href='?id={{$u->id}}&sil'
                                                                        } else {
                                                                            swal("Dikkat", "Silme işlemi iptal edildi...", "error");
                                                                        }
                                                                    });
                                                                });
                                                            });
                                                        </script>
                                                        <a href="{{route('yorum_duzenle', ['id'=>$u->id])}}"
                                                           class="btn btn-outline-info">
                                                            <i class="la la-edit"></i>
                                                            Düzenle
                                                        </a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>İsim Soyisim</th>
                                                <th>Ünvan</th>
                                                <th>Fotoğraf</th>
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
