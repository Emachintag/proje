
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/public/back/app-assets/vendors/css/editors/tinymce/tinymce.min.css')}}">
@endsection
@extends('back.layouts.app')
@section('content')
    <?php
    if(isset($_GET['id'])) {
        $blog = DB::table('blog')->where('id', $_GET['id'])->first();
    } else {
        header("Location:".route('Blog'));
    }

    ?>
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-body">
                <!-- input groups start -->

                <!-- input groups end -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="row-separator-colored-controls">Blog Ekle</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-newspaper-o"></i>Blog</h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Blog Başlığı</label>
                                                                <div class="input-group">
                                                                    <input value="{{$blog->title}}" name="title" type="text" class="form-control" placeholder="Başlık" aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Blog Alt Başlığı</label>
                                                                <div class="input-group">
                                                                    <input value="{{$blog->title_2}}" name="title_2" type="text" class="form-control" placeholder="Alt Başlık" aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Kategori</label>
                                                                <div class="input-group">
                                                                    <select name="kategori" class="form-control" id="basicSelect">
                                                                        <option>Select Option</option>
                                                                        <option>Option 1</option>
                                                                        <option>Option 2</option>
                                                                        <option>Option 3</option>
                                                                        <option>Option 4</option>
                                                                        <option>Option 5</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="card-body">
                                                                    <div class="card-block">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                @if($blog->image != '')
                                                                                    <label>Blog Görseli</label>
                                                                                    <div class="input-group">
                                                                                        <img src="{{asset('public/img/'.$blog->image)}}" class="form-control">
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label>Blog Görsel (Tek Fotoğraf)</label>
                                                                                <div class="input-group">
                                                                                    <input name="image" type="file" class="form-control" placeholder="Alt Başlık" aria-describedby="basic-addon3">
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-md-6">
                                                                        <label class="label-control" for="userinput4">Yeni Resim Yükle ( Çoklu )</label>
                                                                        <input
                                                                            id="userinput4"
                                                                            type="file"
                                                                            name="images[]"
                                                                            class="btn btn-block btn-outline-pink form-control"
                                                                            accept="image/*"
                                                                            multiple
                                                                        >
                                                                    </div>
                                                                    <div class="col-sm-6 col-md-3">
                                                                        @if(DB::table('blog_gorsel')->where('Blog_id', $blog->id)->get())
                                                                            @foreach(DB::table('blog_gorsel')->where('Blog_id', $blog->id)->get() as $uuuu)
                                                                                <div class="row mt-1">
                                                                                    <div class="col-9">
                                                                                        <img class="form-control" src="{{asset('public/img/'.$uuuu->gorsel)}}" style="width: 100%;">
                                                                                    </div>
                                                                                    <div class="col-3">
                                                                                        <button type="button" onclick="location.href='?gorselSil&gorsel={{$uuuu->id}}'" class="btn btn-outline-danger ml-1"><i class="ft ft-minus"></i> Sil</button>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <span class="text-danger">Galeriye Resim Yüklenmemiş</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="card-body">
                                                                    <div class="card-block">
                                                                        @if($blog->pdf != '')
                                                                            <label>Blog Belge</label>
                                                                            <div class="input-group">
                                                                                <a target="_blank" href="{{asset('public/img/'.$blog->pdf)}}">
                                                                                    <span class="text-success"><i class="fa fa-external-link"></i>
                                                                                        Belgeyi Görüntülemek İçin Tıklayın
                                                                                    </span>
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                        <label>Blog Belge (Tek PDF)</label>
                                                                        <div class="input-group">
                                                                            <input name="pdf" type="file" class="form-control" placeholder="Alt Başlık" aria-describedby="basic-addon3">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-md-6">
                                                                        <label class="label-control" for="userinput4">Yeni Resim PDF ( Çoklu )</label>
                                                                        <input
                                                                            id="userinput4"
                                                                            type="file"
                                                                            name="pdfs[]"
                                                                            class="btn btn-block btn-outline-pink form-control"
                                                                            accept="image/*"
                                                                            multiple
                                                                        >
                                                                    </div>
                                                                    <div class="col-sm-6 col-md-6">
                                                                        @if(DB::table('blog_belge')->where('blog_id', $blog->id)->get())
                                                                            @foreach(DB::table('blog_belge')->where('Blog_id', $blog->id)->get() as $uuuu)
                                                                                <div class="row mt-3">
                                                                                    <div class="col-9">
                                                                                        <a target="_blank" href="{{asset('public/img/'.$uuuu->belge)}}">
                                                                                        <span class="text-success form-control"><i class="fa fa-external-link"></i>
                                                                                        Belgeyi Görüntülemek İçin Tıklayın
                                                                                    </span></a>
                                                                                    </div>
                                                                                    <div class="col-3">
                                                                                        <button type="button" onclick="location.href='?gorselSil&gorsel={{$uuuu->id}}'" class="btn btn-outline-danger ml-1"><i class="ft ft-minus"></i> Sil</button>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <span class="text-danger"> PDF Yüklenmemiş</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>



                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="card-body">
                                                            <div class="card-block">
                                                                <label>Blog Metni</label>
                                                                <div class="form-group">
                                                                    <textarea name="text" class="tinymce">{{$blog->text}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit" class="btn btn-success btn-min-width btn-glow mr-1 mb-1">Gönder</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('/public/back/app-assets/vendors/js/editors/tinymce/tinymce.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/back/app-assets/js/scripts/editors/editor-tinymce.js')}}" type="text/javascript"></script>
@endsection
