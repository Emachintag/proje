@extends('layouts.app')
@section('content')
    <?php
    $u = DB::table('blog')->where('url', $id)->first();
    ?>


@endsection

