@extends('layouts.master')
@section('title',$product->name)
@section('content')
<div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('homepage')}}">Ana səhifə</a></li>
            @foreach($categories as $category)
            <li><a href="{{route('category',$category->slug)}}">{{$category->name}}</a></li>
            @endforeach
            <li class="active">{{$product->name}}</li>
        </ol>
        <div class="bg-content">
            <div class="row">
                <div class="col-md-5">
                    <img src="http://via.placeholder.com/400x200?text=Product Image">
                    <hr>
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="http://via.placeholder.com/60x60?text=Product Image"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="http://via.placeholder.com/60x60?text=Product Image"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="http://via.placeholder.com/60x60?text=Product Image"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h1>{{$product->name}}</h1>
                    <p class="price">{{$product->price}} ₺</p>
                    <form action="{{route('add.basket')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="submit" class="btn btn-theme" value="Add to Basket">
                    </form>
                </div>
            </div>

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#t1" data-toggle="tab">Product Description</a></li>
                    <li role="presentation"><a href="#t2" data-toggle="tab">Comments</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="t1">{{$product->desc}}</div>
                    <div role="tabpanel" class="tab-pane" id="t2">Hele yorum yoxdu )</div>
                </div>
            </div>

        </div>
    </div>
@endsection