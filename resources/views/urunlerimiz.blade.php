@extends('layouts.app')
@section('content')

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section id="subheader" class="text-white" data-stellar-background-ratio=".2" data-bgimage="url({{asset('/public/front/images/background/subheader3.jpg')}}) top">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Ürünlerimiz</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->
        <!-- section begin -->
        <section aria-label="section">
            <div class="container">
                <div class="row">
                    @foreach(DB::table('urun')->orderBy('id','desc')->get() as $u)
                    <div class="col-lg-4 col-md-6 mb30">
                        <div class="bloglist item">
                            <div class="post-content">
                                <div class="post-image">
                                    <img alt="" src="{{asset('public/img/'.$u->image)}}">
                                </div>
                                <div class="post-text">
                                    <h4><a href="{{route('urun_detay',$u->url)}}">{{$u->title}}<span></span></a></h4>
                                    <p>{{$u->title_2}}</p>
                                    <a href="{{route('urun_detay',$u->url)}}"><span class="p-author">Devamını oku...</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    <div class="spacer-single"></div>

                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
    <a href="#" id="back-to-top"></a>
@endsection
