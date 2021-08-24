@extends('back.layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/vendors/css/charts/morris.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
@section('content')
    <?php
    date_default_timezone_set('Europe/Istanbul');
    $istatistikler = DB::table('istatistik')->get();
    foreach ($istatistikler as $i) {
        $browser[] = $i->browser;
    }
    $browsers = array_unique($browser);
    foreach ($browsers as $bs) {
        $findBrowserCount[] = DB::table('istatistik')->where('browser', $bs)->count();
    }

    foreach ($istatistikler as $i) {
        $device[] = $i->device;
    }
    $devices = array_unique($device);
    foreach ($devices as $ds) {
        $findDeviceCount[] = DB::table('istatistik')->where('device', $ds)->count();
    }
    for ($i=0; $i < 10; $i++) {
        $last30day[] = date('Y-m-d',strtotime("-".$i." days"));
    }
    foreach (array_reverse($last30day) as $ld) {
        $daysCountTekil[] = DB::table('istatistik')->whereDate('date', '=', $ld)->where('tekil', '1')->count();
        $daysCountCogul[] = DB::table('istatistik')->whereDate('date', '=', $ld)->where('tekil', '0')->count();
    }
    $i = '0';

    foreach ($istatistikler as $i) {
        $page[] = $i->page;
    }

    $sayfaSayim = array_count_values($page);

    $pagesTek = array_unique($page);
    ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- modüller -->
                <div class="row mb-3">
                        @if(DB::table('belge')->count() == '')
                        @else
                    <div class="col mb-2" style="height: 125px;">
                        <div class="card h-100 pull-up bg-gradient-directional-danger">
                            <div class="card-content">
                                <a href="{{route('belge')}}">
                                    <div class="card-body text-center">
                                        <i class="la la-user-secret text-white la-2x"></i>
                                        <br>
                                        <h3><span class="text-white">Belge</span></h3>
                                        <h1><span class="text-white">{{DB::table('belge')->count()}}</span></h1>
                                    </div></a>
                            </div>
                        </div>
                    </div>
                        @endif
                        @if(DB::table('urun')->count() == '')
                        @else
                    <div class="col mb-2" style="height: 125px;">
                        <div class="card h-100 pull-up bg-gradient-directional-warning">
                            <div class="card-content">
                                <a href="{{route('urun')}}">
                                <div class="card-body text-center">
                                    <i class="la la-paste text-white la-2x"></i>
                                    <br>
                                    <h3><span class="text-white">Ürünler</span></h3>
                                    <h1><span class="text-white">{{DB::table('urun')->count()}}</span></h1>
                                </div></a>
                            </div>
                        </div>
                    </div>
                        @endif
                        @if(DB::table('galeri')->count() == '')
                        @else
                    <div class="col mb-2" style="height: 125px;">
                        <div class="card h-100 pull-up bg-gradient-directional-primary">
                            <div class="card-content">
                                <a href="{{route('galeri')}}" ><div class="card-body text-center">
                                    <i class="la la-info-circle text-white la-2x"></i>
                                    <br>
                                    <h3><span class="text-white">Galeri</span></h3>
                                    <h1><span class="text-white">{{DB::table('galeri')->count()}}</span></h1>
                                </div></a>
                            </div>
                        </div>
                    </div>
                        @endif
                        @if(DB::table('slider')->count() == '')
                        @else
                    <div class="col mb-2" style="height: 125px;">
                        <div class="card h-100 pull-up bg-gradient-directional-purple">
                            <div class="card-content">
                                <a href="{{route('slider')}}" >
                                <div class="card-body text-center">
                                    <i class="la la-forward text-white la-2x"></i>
                                    <br>
                                    <h3><span class="text-white">Slider</span></h3>
                                    <h1><span class="text-white">{{DB::table('slider')->count()}}</span></h1>
                                </div></a>
                            </div>
                        </div>
                    </div>
                        @endif
                    <br>
                </div>


                <!-- / modüller sonu -->

                <!-- / Ziyaretçi İstatistikleri -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border-left-pink border-left-2">
                            <div class="card-header">
                                <h4 class="card-title">Ziyaretçi İstatistikleri</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div id="smooth-area-chart" class="height-400"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Ziyaretçi İstatistikleri sonu -->

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="card border-left-pink border-left-2">
                            <div class="card-header">
                                <h4 class="card-title">Ziyaretçi / Tarayıcı</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div id="bar-chart" class="height-400"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div class="card border-left-pink border-left-2">
                            <div class="card-header">
                                <h4 class="card-title">Ziyaretçi / İşletim Sistemi</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div id="bar-chart2" class="height-400"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card border-left-pink border-left-2">
                            <div class="card-header">
                                <h4 class="card-title">Sayfa Ziyaret Oranları</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table
                                        class="table table-striped table-bordered zero-configuration1 text-center"
                                    >
                                        <thead>
                                        <tr>
                                            <th>Sayfa</th>
                                            <th>Ziyaretçi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pagesTek as $p)
                                            <tr>
                                                <td><a href="/{{$p}}" target="_blank">{{$p}}</a></td>
                                                <td>
                                                    {{$sayfaSayim[$p]}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Sayfa</th>
                                            <th>Ziyaretçi</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
@endsection
@section('js')
    <script src="{{asset('/public/back/app-assets/vendors/js/charts/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/vendors/js/charts/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.zero-configuration1').DataTable( {
                columnDefs: [ { orderable: false, targets: [ 0 ] } ],
                pageLength: 10,
                "order": [[ 1, "desc" ]],
                "language": {
                    "decimal":        "",
                    "emptyTable":     "Henüz hiç istatistik yok.",
                    "info":           "_TOTAL_ adet sayfa içinden _START_ - _END_ arası gösteriliyor",
                    "infoEmpty":      "Toplamda 0 istatistik var.",
                    "infoFiltered":   "(_MAX_ adet sayfa içinde arama yapılıyor)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "_MENU_ sayfa gösteriliyor",
                    "loadingRecords": "Yükleniyor...",
                    "processing":     "İşleniyor...",
                    "search":         "Ara:",
                    "zeroRecords":    "Eşleşen sayfa bulunamadı",
                    "paginate": {
                        "first":      "İlk",
                        "last":       "Son",
                        "next":       "Sonraki",
                        "previous":   "Önceki"
                    },
                }
            } );
        } );
    </script>
    <script type="text/javascript">
        $(window).on("load", function(){
            Morris.Area({
                element: 'smooth-area-chart',
                data: [
                        <?php
                        $i = 0;
                        $a = 0;
                        ?>
                        @foreach(array_reverse($last30day) as $ds)
                    {
                        tarih: '{{$ds}}',
                        tekil: {{$daysCountTekil[$i]}},
                        cogul: {{$daysCountCogul[$a]}}
                    },
                    <?php $i = $i + 1; ?>
                    <?php $a = $a + 1; ?>
                    @endforeach
                ],
                xkey: 'tarih',
                ykeys: ['tekil', 'cogul'],
                labels: ['Tekil', 'Çoğul'],
                behaveLikeLine: true,
                ymax: 'auto',
                resize: true,
                pointSize: 0,
                pointStrokeColors:['#BABFC7', '#5175E0'],
                smooth: true,
                gridLineColor: '#e3e3e3',
                numLines: 6,
                gridtextSize: 14,
                lineWidth: 0,
                fillOpacity: 0.8,
                hideHover: 'auto',
                lineColors: ['#e83e8c', '#FF4961']
            });
        });
    </script>
    <script>
        $(window).on("load", function(){
            Morris.Bar({
                element: 'bar-chart',
                data: [
                        <?php $i = 0; ?>
                        <?php $ascii = ord('a'); ?>
                        @foreach($browsers as $bs)
                    {
                        y: '{{$bs}}',
                        a : {{$findBrowserCount[$i]}},
                    },
                    <?php $i = $i + 1; ?>
                    @endforeach
                ],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Ziyaretçi'],
                barGap: 1   ,
                barSizeRatio: 0.75,
                smooth: true,
                gridLineColor: '#e3e3e3',
                numLines: 5,
                gridtextSize: 14,
                fillOpacity: 0.4,
                resize: true,
                barColors: ['#e83e8c']
            });
        });
    </script>

    <script>
        $(window).on("load", function(){
            Morris.Bar({
                element: 'bar-chart2',
                data: [
                        <?php $i = 0; ?>
                        @foreach($devices as $ds)
                    {
                        y: '{{$ds}}',
                        a : {{$findDeviceCount[$i]}},
                    },
                    <?php $i = $i + 1; ?>
                    @endforeach
                ],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Ziyaretçi'],
                barGap: 1   ,
                barSizeRatio: 0.75,
                smooth: true,
                gridLineColor: '#e3e3e3',
                numLines: 5,
                gridtextSize: 14,
                fillOpacity: 0.4,
                resize: true,
                barColors: ['#FF4961']
            });
        });
    </script>
@endsection
