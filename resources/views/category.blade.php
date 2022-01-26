@extends('layouts.master')
@section('title',$category->name)
@section('content')
<div class="container">
         <ol class="breadcrumb">
            <li><a href="{{route('homepage')}}">Anasayfa</a></li>
            <li class="active">{{$category->name}}</li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$category->name}}</div>
                    <div class="panel-body">
                        <h3>Alt Kategoriler</h3>
                        <div class="list-group categories">
                            @foreach($down_categories as $down_category)
                            <a href="{{route('category',$down_category->slug)}}" class="list-group-item">
                                <i class="fa fa-arrow-circle-right"></i>
                                 {{$down_category->name}}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    Sırala
                    <a href="#" class="btn btn-default">Çok Satanlar</a>
                    <a href="#" class="btn btn-default">Yeni Ürünler</a>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 product">
                            <a href="#"><img src="http://lorempixel.com/400/400/food/1"></a>
                            <p><a href="#">Ürün adı</a></p>
                            <p class="price">129 ₺</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                        <div class="col-md-3 product">
                            <a href="#"><img src="http://lorempixel.com/400/400/food/2"></a>
                            <p><a href="#">Ürün adı</a></p>
                            <p class="price">129 ₺</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                        <div class="col-md-3 product">
                            <a href="#"><img src="http://lorempixel.com/400/400/food/3"></a>
                            <p><a href="#">Ürün adı</a></p>
                            <p class="price">129 ₺</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                        <div class="col-md-3 product">
                            <a href="#"><img src="http://lorempixel.com/400/400/food/4"></a>
                            <p><a href="#">Ürün adı</a></p>
                            <p class="price">129 ₺</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection