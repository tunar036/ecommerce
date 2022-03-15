@extends('layouts.master')
@section('title',$category->name)
@section('content')
<div class="container">
         <ol class="breadcrumb">
            <li><a href="{{route('homepage')}}">Ana səhifə</a></li>
            <li class="active">{{$category->name}}</li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$category->name}}</div>
                    <div class="panel-body">
                    @if(count($down_categories)>0)
                    <h3>Alt Kategoriyalar</h3>
                    <div class="list-group categories">
                        @foreach($down_categories as $down_category)
                        <a href="{{route('category',$down_category->slug)}}" class="list-group-item">
                            <i class="fa fa-arrow-circle-right"></i>
                            {{$down_category->name}}
                        </a>
                        @endforeach
                    </div>
                    @else
                    Bu kategoriyada bashqa alt kategoriya yoxdur.
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                @if(count($products)>0)
                    Sırala
                    <a href="?order=bestselling" class="btn btn-default">Çok Satanlar</a>
                    <a href="?order=new" class="btn btn-default">Yeni Ürünler</a>
                    <hr>
                    @endif
                    <div class="row">
                        @if(count($products)==0)
                           <div class="col-md-12">Bu kategoriyada mehsul yoxdur!</div>
                        @endif
                        @foreach($products as $product)
                        <div class="col-md-3 product">
                            <a href="{{route('product',$product->slug)}}"><img src="{{$product->detail->product_image != null ? asset('/uploads/products/'.$product->detail->product_image) : 'http://via.placeholder.com/400x400?text=Product Image'}}"></a>
                            <p><a href="{{route('product',$product->slug)}}">{{$product->name}}</a></p>
                            <p class="price">{{$product->price}} ₺</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                        @endforeach
                    </div>
                    {{request()->has('order') ? $products->appends(['order'=>request('order')])->links() : $products->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection