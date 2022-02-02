@extends('layouts.master')
@section('title','Error Page')
@section('content')
    <div class="container">
        <div class="jumbotron text-center">
            <h1>404</h1>
            <h2>Axtardiginiz sehife tapilmadi</h2>
            <a href="{{route('homepage')}}" class="btn btn-primary">Ana Sehifeye don</a>
        </div>
    </div>
@endsection