@extends('layouts.app')
@section('content')
    <?php
    $u = DB::table('hizmet')->where('url', $id)->first();
    ?>


@endsection

