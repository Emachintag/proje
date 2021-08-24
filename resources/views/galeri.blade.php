@extends('layouts.app')
@section('content')

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section id="subheader" class="text-white" data-stellar-background-ratio=".2" data-bgimage="url({{asset('/public/front/images/background/subheader3.jpg')}}) top">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <div class="spacer-single"></div>
                            <h1>Galeri</h1>
                            <p>Ürün Galerisi</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section begin -->
        <section aria-label="section">
            <div class="container">
                <div class="row">
                    @foreach(DB::table('galeri')->orderBy('id','desc')->get() as $u)
                    <div class="col-md-4 mb30">
                        <div class="de-image-hover">
                            <a href="{{asset('public/img/'.$u->image)}}" class="image-popup">
                                    <span class="dih-title-wrap">
                                        <span class="dih-title">{{$u->title}}</span>
                                    </span>
                                <span class="dih-overlay"></span>
                                <img src="{{asset('public/img/'.$u->image)}}" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
    <a href="#" id="back-to-top"></a>
@endsection
