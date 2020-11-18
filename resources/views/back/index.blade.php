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
                    <div class="col-lg-2 col-4" style="height: 125px;">
                        <div class="card h-100 pull-up bg-gradient-directional-info">
                            <div class="card-content">
                                <a href="{{route('haber')}}"><div class="card-body text-center">
                                    <i class="la la-newspaper-o text-white la-2x"></i>
                                    <br>
                                    <h3><span class="text-white">Haberler</span></h3>
                                    <h1><span class="text-white">{{DB::table('haber')->count()}}</span></h1>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-4" style="height: 125px;">
                        <div class="card h-100 pull-up bg-gradient-directional-danger">
                            <div class="card-content">
                                <a href="{{route('blog')}}">
                                <div class="card-body text-center">
                                    <i class="la la-newspaper-o text-white la-2x"></i>
                                    <br>
                                    <h3><span class="text-white">Bloglar</span></h3>
                                    <h1><span class="text-white">{{DB::table('blog')->count()}}</span></h1>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-4" style="height: 125px;">
                        <div class="card h-100 pull-up bg-gradient-directional-success">
                            <div class="card-content">
                                <a href="{{route('hizmet')}}">
                                <div class="card-body text-center">
                                    <i class="la la-recycle text-white la-2x"></i>
                                    <br>
                                    <h3><span class="text-white">Hizmetler</span></h3>
                                    <h1><span class="text-white">{{DB::table('hizmet')->count()}}</span></h1>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-4" style="height: 125px;">
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
                    <div class="col-lg-2 col-4" style="height: 125px;">
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
                    <div class="col-lg-2 col-4" style="height: 125px;">
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















                <!-- Revenue, Hit Rate & Deals -->
                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Revenue</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row mb-1">
                                        <div class="col-6 col-md-4">
                                            <h5>Current week</h5>
                                            <h2 class="danger">$82,124</h2>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <h5>Previous week</h5>
                                            <h2 class="text-muted">$52,502</h2>
                                        </div>
                                    </div>
                                    <div class="chartjs">
                                        <canvas id="thisYearRevenue" width="400" style="position: absolute;"></canvas>
                                        <canvas id="lastYearRevenue" width="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="card pull-up">
                                    <div class="card-header bg-hexagons">
                                        <h4 class="card-title">Hit Rate
                                            <span class="danger">-12%</span>
                                        </h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-content collapse show bg-hexagons">
                                        <div class="card-body pt-0">
                                            <div class="chartjs">
                                                <canvas id="hit-rate-doughnut" height="275"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card pull-up">
                                    <div class="card-content collapse show bg-gradient-directional-danger ">
                                        <div class="card-body bg-hexagons-danger">
                                            <h4 class="card-title white">Deals
                                                <span class="white">-55%</span>
                                                <span class="float-right">
                          <span class="white">152</span>
                          <span class="red lighten-4">/200</span>
                        </span>
                                            </h4>
                                            <div class="chartjs">
                                                <canvas id="deals-doughnut" height="275"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    <h6 class="text-muted">Order Value </h6>
                                                    <h3>$ 88,568</h3>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="icon-trophy success font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    <h6 class="text-muted">Calls</h6>
                                                    <h3>3,568</h3>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="icon-call-in danger font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Revenue, Hit Rate & Deals -->
                <!-- Emails Products & Avg Deals -->
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Emails</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <p>Open rate
                                        <span class="float-right text-bold-600">89%</span>
                                    </p>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-1">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 80%"
                                             aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="pt-1">Sent
                                        <span class="float-right">
                      <span class="text-bold-600">310</span>/500</span>
                                    </p>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-1">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 48%"
                                             aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Top Products</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a href="#">Show all</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                            <tr>
                                                <th scope="row" class="border-top-0">iPone X</th>
                                                <td class="border-top-0">2245</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">One Plus</th>
                                                <td>1850</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Samsung S7</th>
                                                <td>1550</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">Average Deal Size</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <h6 class="danger text-bold-600">-30%</h6>
                                            <h4 class="font-large-2 text-bold-400">$12,536</h4>
                                            <p class="blue-grey lighten-2 mb-0">Per rep</p>
                                        </div>
                                        <div class="col-md-6 col-12 text-center">
                                            <h6 class="success text-bold-600">12%</h6>
                                            <h4 class="font-large-2 text-bold-400">$18,548</h4>
                                            <p class="blue-grey lighten-2 mb-0">Per team</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Emails Products & Avg Deals -->
                <!-- Total earning & Recent Sales  -->
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-content">
                                <div class="earning-chart position-relative">
                                    <div class="chart-title position-absolute mt-2 ml-2">
                                        <h1 class="display-4">$1,596</h1>
                                        <span class="text-muted">Total Earning</span>
                                    </div>
                                    <canvas id="earning-chart" class="height-450"></canvas>
                                    <div class="chart-stats position-absolute position-bottom-0 position-right-0 mb-2 mr-3">
                                        <a href="#" class="btn round btn-danger mr-1 btn-glow">Statistics <i class="ft-bar-chart"></i></a>
                                        <span class="text-muted">for the <a href="#" class="danger darken-2">last year.</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="recent-sales" class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recent Sales</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right"
                                               href="invoice-summary.html" target="_blank">View all</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content mt-1">
                                <div class="table-responsive">
                                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">Product</th>
                                            <th class="border-top-0">Customers</th>
                                            <th class="border-top-0">Categories</th>
                                            <th class="border-top-0">Popularity</th>
                                            <th class="border-top-0">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-truncate">iPone X</td>
                                            <td class="text-truncate p-1">
                                                <ul class="list-unstyled users-list m-0">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-4.png"
                                                             alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-5.png"
                                                             alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-6.png"
                                                             alt="Avatar">
                                                    </li>
                                                    <li class="avatar avatar-sm">
                                                        <span class="badge badge-info">+8 more</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-danger round">Mobile</button>
                                            </td>
                                            <td>
                                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%"
                                                         aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="text-truncate">$ 1200.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-truncate">iPad</td>
                                            <td class="text-truncate p-1">
                                                <ul class="list-unstyled users-list m-0">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-7.png"
                                                             alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-8.png"
                                                             alt="Avatar">
                                                    </li>
                                                    <li class="avatar avatar-sm">
                                                        <span class="badge badge-info">+5 more</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-success round">Tablet</button>
                                            </td>
                                            <td>
                                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%"
                                                         aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="text-truncate">$ 1190.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-truncate">OnePlus</td>
                                            <td class="text-truncate p-1">
                                                <ul class="list-unstyled users-list m-0">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-1.png"
                                                             alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-2.png"
                                                             alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-3.png"
                                                             alt="Avatar">
                                                    </li>
                                                    <li class="avatar avatar-sm">
                                                        <span class="badge badge-info">+3 more</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-danger round">Mobile</button>
                                            </td>
                                            <td>
                                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 70%"
                                                         aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="text-truncate">$ 999.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-truncate">ZenPad</td>
                                            <td class="text-truncate p-1">
                                                <ul class="list-unstyled users-list m-0">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-11.png"
                                                             alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-12.png"
                                                             alt="Avatar">
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-success round">Tablet</button>
                                            </td>
                                            <td>
                                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 65%"
                                                         aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="text-truncate">$ 1150.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-truncate">Pixel 2</td>
                                            <td class="text-truncate p-1">
                                                <ul class="list-unstyled users-list m-0">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-6.png"
                                                             alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-4.png"
                                                             alt="Avatar">
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-danger round">Mobile</button>
                                            </td>
                                            <td>
                                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 45%"
                                                         aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="text-truncate">$ 1180.00</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Total earning & Recent Sales  -->
                <!-- Analytics map based session -->
                <div class="row">
                    <div class="col-12">
                        <div class="card box-shadow-0">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-9 col-12">
                                        <div id="world-map-markers" class="height-450"></div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="card-body text-center">
                                            <h4 class="card-title mb-0">Visitors Sessions</h4>
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="pb-1">Sessions by Browser</p>
                                                    <div id="sessions-browser-donut-chart" class="height-200"></div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="sales pr-2 pt-2">
                                                        <div class="sales-today mb-2">
                                                            <p class="m-0">Today's
                                                                <span class="success float-right"><i class="ft-arrow-up success"></i> 6.89%</span>
                                                            </p>
                                                            <div class="progress progress-sm mt-1 mb-0">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25"
                                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <div class="sales-yesterday">
                                                            <p class="m-0">Yesterday's
                                                                <span class="danger float-right"><i class="ft-arrow-down danger"></i> 4.18%</span>
                                                            </p>
                                                            <div class="progress progress-sm mt-1 mb-0">
                                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 65%" aria-valuenow="25"
                                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Analytics map based session -->
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
