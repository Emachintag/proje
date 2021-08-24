@extends('layouts.app')
@section('content')
    @php($hakkimizda = DB::table('sakarya')->first())
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section id="subheader" class="text-white" data-stellar-background-ratio=".2" data-bgimage="url({{asset('/public/front/images/background/subheader3.jpg')}}) top">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <div class="spacer-single"></div>
                            <h1>Sakaryamız</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->
        <section aria-label="section" data-bgcolor="#ffffff">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <span class="p-title">Sakaryamız</span><br>
                        <h2>{{$hakkimizda->title}}</h2>
                        <p>{!! $hakkimizda->text !!}</p>
                    </div>
                    <div class="col-md-6 offset-md-1">
                        <div class="de-images">
                            <img class="di-big img-fluid" src="{{asset('public/img/'.$hakkimizda->image)}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- content close -->
    <a href="#" id="back-to-top"></a>
@endsection
