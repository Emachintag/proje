@extends('layouts.app')
@section('content')
    <?php
    $u = DB::table('urun')->where('url', $id)->first();
    ?>

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section id="subheader" class="text-white" data-stellar-background-ratio=".2" data-bgimage="url({{asset('/public/front/images/background/subheader3.jpg')}}) top">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Ürün Detay</h1>
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
                    <div class="col-md-8">
                        <div class="blog-read">
                            <img alt="" src="{{asset('public/img/'.$u->image)}}" class="img-fullwidth">
                            <h3>{{$u->title}}</h3>
                            <div class="post-text">
                                <p>{!! $u->text !!}</p>

                            </div>

                                    <div class="row">
                                        @foreach(DB::table('urun_gorsel')->where('urun_id' , $u->id)->get() as $uuu)
                                            <div class="col-md-3 mb30">
                                                <div class="de-image-hover">
                                                    <a href="{{asset('/public/img/'.$uuu->gorsel)}}" class="image-popup">
                                                        <span class="dih-overlay"></span>
                                                        <img src="{{asset('/public/img/'.$uuu->gorsel)}}" class="img-fluid" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                            @if($u->youtube != '')
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$u->youtube}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @endif
                        </div>


                    </div>
                    <div id="sidebar" class="col-md-4">
                        <div class="widget widget-post">
                            <h4>Diğer Ürünler</h4>
                            <div class="small-border"></div>
                            <ul>
                                @foreach(DB::table('urun')->take(4)->orderBy('id','desc')->get() as $uu)
                                    @if($u->id != $uu->id)
                                <li><a href="{{route('urun_detay',$uu->url)}}">{{$uu->title}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- content close -->
    <a href="#" id="back-to-top"></a>
@endsection

@section('meta')

    <meta property="og:type" content="website" />
    <meta name="description" content="{{$u->title_2}}">
    <meta property="og:title" content="{{$u->title}}" />
    <meta property="og:url" content="{{$u->url}}" />
    <meta property="og:image" content="{{asset('/public/img/'.$u->image)}}" />
    <meta property="og:url" content="{{url()->full()}}">
@endsection
