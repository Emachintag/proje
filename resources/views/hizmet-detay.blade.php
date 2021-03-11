@extends('layouts.app')
@section('content')
    <?php
    $u = DB::table('hizmet')->where('url', $id)->first();
    ?>


@endsection

@section('meta')

    <meta property="og:type" content="website" />
    <meta name="description" content="{{$u->title_2}}">
    <meta property="og:title" content="{{$u->title}}" />
    <meta property="og:url" content="{{$u->url}}" />
    <meta property="og:image" content="{{asset('/public/img/'.$u->image)}}" />
    <meta property="og:url" content="{{url()->full()}}">
@endsection
