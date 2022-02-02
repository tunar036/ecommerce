@extends('layouts.master')
@section('title','Search Product')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('homepage')}}">Ana sehife</a></li>
            <li class="active">Arama neticesi</li>
        </ol>
    </div>

    <div class="products bg-content">
        <div class="row">
            @if(count($products) == 0)
                <div class="col-md-12 text-center">
                    Axtarisha uygun netice tapilmadi
                </div>
            @endif
            @foreach($products as $product)
                <div class="col-md-2 product">
                    <a href="{{route('product',$product->slug)}}">
                        <img src="http://via.placeholder.com/640x400?text=Product Image" alt="{{$product->name}}">
                    </a>
                    <p>
                        <a href="{{route('product',$product->slug)}}">
                            {{$product->name}}
                    </p>
                    <p class="price">{{$product->price}} ₺</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
