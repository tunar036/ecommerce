@extends('layouts.master')
@section('title','Homepage')
@section('content')

    @include('layouts.partials.alert')
    @if(Auth::user() and Auth::user()->is_active == 0)
    <div class="container">
        <div class="alert-danger panel-heading">

                        Hesabınızı təsdiqləmək üçün emailinizə təsdiq mesajı
                        <a href="#" onclick="event.preventDefault(); document.getElementById('activation').submit()">GÖNDƏRİN</a>
                                <form id="activation" action="{{route('activate_user',Auth::user()->id)}}" method="POST" style="display: none;">
                                    @csrf
        </div>                        </form>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategoriyalar</div>
                    <div class="list-group categories">
                        @foreach($categories as $category)
                            <a href="{{route('category',$category->slug)}}" class="list-group-item">
                                <i class="fa fa-arrow-circle-o-right"></i> 
                                {{$category->name}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i=0;$i<count($product_slider);$i++)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="{{$i ==0 ? 'active' : ''}}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($product_slider as $index => $product)
                        <div class="item {{$index == 0 ? 'active' : ''}}">
                            <img src="{{$product->detail->product_image!=null ? asset('/uploads/products/'.$product->detail->product_image) : 'http://via.placeholder.com/400x400/?text=Product Image'}}"  style="min-width: 100%" alt="...">
                            <div class="carousel-caption">
                                {{$product->name}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Günün Furseti</div>
                    <div class="panel-body">
                        <a href="{{route('product',$product_opportunity->slug)}}">
                            <img src="{{$product_opportunity->detail->product_image != null ? asset('/uploads/products/'.$product_opportunity->detail->product_image) : 'http://via.placeholder.com/400x485/?text=Product Image'}}" class="img-responsive" style="min-width: 100%">
                            {{$product_opportunity->name}}
                        </a>
                 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">One chixan mehsullar</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($product_featured as $product)
                        <div class="col-md-3 product">
                            <a href="{{route('product',$product->slug)}}"><img src="{{$product->detail->product_image!=null ? asset('/uploads/products/'.$product->detail->product_image) : 'http://via.placeholder.com/400x400/?text=Product Image'}}"></a>
                            <p><a href="{{route('product',$product->slug)}}">{{$product->name}}</a></p>
                            <p class="price">{{$product->price}} manat</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Chox satilan mehsullar</div>
                <div class="panel-body">
                    <div class="row">
                    @foreach($product_bestselling as $product)
                        <div class="col-md-3 product">
                            <a href="{{route('product',$product->slug)}}"><img src="{{$product->detail->product_image!=null ? asset('/uploads/products/'.$product->detail->product_image) : 'http://via.placeholder.com/400x400/?text=Product Image'}}"></a>
                            <p><a href="{{route('product',$product->slug)}}">{{$product->name}}</a></p>
                            <p class="price">{{$product->price}} manat</p>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Endirimli mehsullar</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($product_discount as $product)
                        <div class="col-md-3 product">
                            <a href="{{route('product',$product->slug)}}"><img src="{{$product->detail->product_image!=null ? asset('/uploads/products/'.$product->detail->product_image) : 'http://via.placeholder.com/400x400/?text=Product Image'}}"></a>
                            <p><a href="{{route('product',$product->slug)}}">{{$product->name}}</a></p>
                            <p class="price">{{$product->price}} manat</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection