@extends('layouts.app')
@section('content')
    <?php
    $u = DB::table('haber')->where('url', $id)->first();
    ?>

@endsection


