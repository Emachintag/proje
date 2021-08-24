@extends('layouts.app')
@section('content')
    @php
        $iletisim = DB::table('iletisim_ayarlar')->first();
$sosyal = DB::table('sosyal_medya_ayarlar')->first();
    @endphp
    <style>
        iframe {
            width: 100%;
        }
    </style>
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section id="subheader" class="text-white" data-stellar-background-ratio=".2" data-bgimage="url({{asset('/public/front/images/background/subheader3.jpg')}}) top">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>İletişim</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->
        <section aria-label="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">

                        <h3>İletişim Bilgileri</h3>
                        <address class="s1">
                            <span><i class="id-color fa fa-map-marker fa-lg"></i>{{$iletisim->adres}}</span>
                            @if($iletisim->tel_1 != '')
                                <span><i class="id-color fa fa-phone fa-lg"></i><a href="tel:{{$iletisim->tel_1}}" >{{$iletisim->tel_1}}</a></span>
                            @endif
                            @if($iletisim->tel_2 != '')
                                <span><i class="id-color fa fa-phone fa-lg"></i><a href="tel:{{$iletisim->tel_2}}" >{{$iletisim->tel_2}}</a></span>
                            @endif
                            @if($iletisim->tel_3 != '')
                                <span><i class="id-color fa fa-phone fa-lg"></i><a href="tel:{{$iletisim->tel_3}}" >{{$iletisim->tel_3}}</a></span>
                            @endif
                            @if($iletisim->email != '')
                            <span><i class="id-color fa fa-envelope-o fa-lg"></i><a href="mailto:{{$iletisim->email}}">{{$iletisim->email}}</a></span>
                            @endif
                            @if($iletisim->email_2 != '')
                                <span><i class="id-color fa fa-envelope-o fa-lg"></i><a href="mailto:{{$iletisim->email_2}}">{{$iletisim->email_2}}</a></span>
                            @endif
                        </address>
                    </div>
                    <div class="col-md-6">
                        {!! $iletisim->iframe !!}

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
    <a href="#" id="back-to-top"></a>
@endsection
