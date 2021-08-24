@extends('layouts.app')
@section('content')
    @php
        $iletisim = DB::table('iletisim_ayarlar')->first();
$sosyal = DB::table('sosyal_medya_ayarlar')->first();
$hakkimizda = DB::table('hakkimizda')->first();
$misyon = DB::table('misyon')->first();
$vizyon = DB::table('vizyon')->first();
$tarim = DB::table('tarim')->first();

    @endphp

    <!-- header close -->
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- revolution slider begin -->
        <section id="section-slider" class="fullwidthbanner-container text-white" aria-label="section-slider">
            <div id="slider-revolution">
                <ul>
                    @foreach(DB::table('slider')->orderBy('id','desc')->get() as $s)
                    <li data-transition="fade" data-slotamount="10" data-masterspeed="300" data-thumb="">
                        <!--  BACKGROUND IMAGE -->
                        <img alt="" class="rev-slidebg" data-bgposition="top center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" src="{{asset('public/img/'.$s->image)}}">
                        <div class="tp-caption very-big-white" data-x="0" data-y="280" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;" data-transform_out="opacity:0;y:-100;s:400;e:Power2.easeInOut;" data-start="600" data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <h1>{{$s->title}}</h1>
                        </div>
                        <div class="tp-caption" data-x="0" data-y="360" data-width="480" data-height="none" data-whitespace="wrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;" data-transform_out="opacity:0;y:-100;s:600;e:Power2.easeInOut;" data-start="700">
                            <p class="lead xs-hide">{{$s->title_2}}</p>
                        </div>
                        <div class="tp-caption" data-x="0" data-y="450" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;" data-transform_out="opacity:0;y:-100;s:800;e:Power2.easeInOut;" data-start="800">
                            <a class="btn-custom" href="{!! $s->link !!}">{{$s->buton}}</a>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
        </section>
        <!-- revolution slider close -->
        <section id="section-highlight" class="relative text-light" data-bgcolor="#111111">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <span class="p-title">Hakkımızda</span><br>
                        <h2>
                            {{$hakkimizda->title}}
                        </h2>
                        <div class="small-border sm-left"></div>
                    </div>
                    <div class="col-md-8">
                        <p>{!! $hakkimizda->text_2 !!}
                        </p>
                    </div>
                </div>
                <div class="spacer-double"></div>
            </div>
        </section>
        <section class="no-top relative z1000">
            <div class="container">
                <div class="row mt-100">
                    <div class="col-md-4 mb-sm-30 wow fadeInRight" data-wow-delay=".2s">
                        <div class="mask">
                            <div class="cover">
                                <div class="c-inner">
                                    <h3><i class="icofont-people"></i><span>Misyon</span></h3>
                                    <p>{!! $misyon->text_2 !!}</p>
                                    <div class="spacer20"></div>
                                    <a href="{{route('misyon')}}" class="btn-custom capsule">Daha fazla</a>
                                </div>
                            </div>
                            <img src="{{asset('public/img/'.$misyon->image)}}" alt="" class="img-responsive" />
                        </div>
                    </div>
                    <div class="col-md-4 mb-sm-30 wow fadeInRight" data-wow-delay=".4s">
                        <div class="mask">
                            <div class="cover">
                                <div class="c-inner">
                                    <h3><i class="icofont-home"></i><span>Vizyon</span></h3>
                                    <p>{!! $vizyon->text_2 !!}</p>
                                    <div class="spacer20"></div>
                                    <a href="{{route('vizyon')}}" class="btn-custom capsule">Daha fazla</a>
                                </div>
                            </div>
                            <img src="{{asset('public/img/'.$vizyon->image)}}" alt="" class="img-responsive" />
                        </div>
                    </div>
                    <div class="col-md-4 mb-sm-30 wow fadeInRight" data-wow-delay=".6s">
                        <div class="mask">
                            <div class="cover">
                                <div class="c-inner">
                                    <h3><i class="icofont-law-order"></i><span>Tarım Makinalar</span></h3>
                                    <p>{!! $tarim->text_2 !!}</p>
                                    <div class="spacer20"></div>
                                    <a href="{{route('tarim')}}" class="btn-custom capsule">Daha fazla</a>
                                </div>
                            </div>
                            <img src="{{asset('public/img/'.$tarim->image)}}" alt="" class="img-responsive" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
       <section aria-label="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h2>Öneçıkan Ürünler</h2>
                            <div class="small-border"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach(DB::table('urun')->where('kategori',2)->orderBy('id','desc')->get() as $u)
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
                </div>
            </div>
        </section>


        <section aria-label="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h2>Galeri</h2>
                            <div class="small-border"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach(DB::table('galeri')->take(6)->orderBy('id','desc')->get() as $g)
                        <div class="col-md-4 mb30">
                            <div class="de-image-hover">
                                <a href="{{asset('public/img/'.$g->image)}}" class="image-popup">
                                    <span class="dih-title-wrap">
                                        <span class="dih-title">{{$g->title}}</span>
                                    </span>
                                    <span class="dih-overlay"></span>
                                    <img src="{{asset('public/img/'.$g->image)}}" class="img-fluid" alt="">
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
    <!-- footer begin -->

@endsection
