<?php
use Illuminate\Support\Facades\File;
?>
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/back/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
@extends('back.layouts.app')
@section('content')
    <?php
    if (isset($_GET['id']) AND isset($_GET['sil'])) {
        $id = $_GET['id'];
        // tekli görsel silme
        $kapakFoto = DB::table('insan_kaynaklari')->where('id', $id)->first()->image;
        $kapakFoto = public_path("img/" . $kapakFoto);
        if (File::exists($kapakFoto)) {
            File::delete($kapakFoto);
        }

        DB::table('insan_kaynaklari')->where('id', $id)->delete();
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
                                            <h4 class="text-white">İş İlanı Sayısı</h4>
                                            <span>Yazdığınız İş İlanı Sayısı</span>
                                        </div>
                                        <div class="media-right p-2 media-middle">
                                            <h1 class="text-white">{{DB::table('insan_kaynaklari')->count()}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div style="cursor: pointer" onclick="location.href='{{route('insan_ekle')}}'"
                                     class="card-content">
                                    <div class="media align-items-stretch bg-gradient-x-info text-white rounded">
                                        <div class="p-2 media-middle">
                                            <i class="icon-pencil font-large-2 text-white"></i>
                                        </div>
                                        <div class="media-body p-2">
                                            <h4 class="text-white">Yeni İş İlanı Ekle</h4>
                                            <span>Yeni İş İlanı İçin Tıklayınız</span>
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
                                    <h4 class="card-title">İş İlanı Listeleme</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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
                                                <th>Başlık</th>
                                                <th>Açıklama</th>
                                                <th>Resim</th>
                                                <th>Yayın Tarihi</th>
                                                <th>İşlem</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(DB::table('insan_kaynaklari')->get() as $u)
                                                <tr>
                                                    <td style="text-align: center">{{$u->title}}</td>
                                                    <td style="text-align: center">{{$u->title_2}}</td>
                                                    <td style="text-align: center"><img class="img" src="{{asset('/public/img/'.$u->image)}}" height="100"></td>
                                                    <td>{{$u->created_at}}</td>
                                                    <td style="text-align: center">
                                                        <button id="delete-confir{{$u->id}}" class="btn btn-outline-danger">
                                                            <i class="la la-remove"></i>
                                                            Sil
                                                        </button>
                                                        <script>
                                                            $(document).ready(function(){
                                                                $('#delete-confir{{$u->id}}').on('click',function(){
                                                                    swal({
                                                                        title: "İş ilanı Yazısı Silme",
                                                                        text: "{{$u->title}} - yazı tamamen silinecektir. Onaylıyor musunuz?",
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
                                                        <a href="{{route('insan_duzenle', ['id'=>$u->id])}}"
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
                                                <th>Başlık</th>
                                                <th>Açıklama</th>
                                                <th>Resim</th>
                                                <th>Yayın Tarihi</th>
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
    <script src="{{asset('/public/back/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"
            type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.zero-configuration').DataTable({
                pageLength: 10,
                "paging": false,
                "order": [[3, "desc"]],
                "language": {
                    "decimal": "",
                    "emptyTable": "Henüz hiç veri yok.",
                    "info": "_TOTAL_ adet veri içinden _START_ - _END_ arası gösteriliyor",
                    "infoEmpty": "Toplamda 0 veri var.",
                    "infoFiltered": "(_MAX_ adet veri içinde arama yapılıyor)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "_MENU_ veri gösteriliyor",
                    "loadingRecords": "Yükleniyor...",
                    "processing": "İşleniyor...",
                    "search": "Ara:",
                    "zeroRecords": "Eşleşen veri bulunamadı",
                    "paginate": {
                        "first": "İlk",
                        "last": "Son",
                        "next": "Sonraki",
                        "previous": "Önceki"
                    },
                }
            });
        });
    </script>
@endsection
