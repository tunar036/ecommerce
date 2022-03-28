@extends('layouts.master')
@section('title','Order detail')
@section('content')
<div class="container">
        <div class="bg-content">
            <a href="{{route('orders')}}" class="btn btn-xs btn-primary">
                <i class="glyphicon glyphicon-arrow-left"> Sifarişlərə dön</i>
            </a>
            <h2>Sipariş (SP-{{$order->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Məhsul</th>
                    <th>Məbləğ</th>
                    <th>Ədəd</th>
                    <th>Cəmi</th>
                    <th>Vəziyyət</th>
                </tr>
                @foreach($order->basket->basket_product as $basket_product)
                <tr>
                    <td style="width: 120px;"> 
                        <a href="{{route('product',$basket_product->product->slug)}}">
                            <img style="width:100px" src="{{$basket_product->product->detail->product_image != null ? asset('/uploads/products/'.$basket_product->product->detail->product_image) : 'http://via.placeholder.com/120x100?text=Product Image'}}"></td>
                        </a>
                    <td>
                        <a href="{{route('product',$basket_product->product->slug)}}">
                            {{$basket_product->product->name}}
                        </a>
                    </td>
                    <td>{{$basket_product->price}} manat</td>
                    <td>{{$basket_product->pieces}}</td>
                    <td>{{$basket_product->price * $basket_product->pieces}} manat</td>
                    <td>{{$basket_product->status}}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Cəmi Məbləğ</th>
                    <td colspan="2">{{$order->order_amount}} manat</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Cəmi Məbləğ (ƏDV ilə)</th>
                    <td colspan="2">{{$order->order_amount * ((100+ config('cart.tax'))/100)}} manat</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Məhsulun vəziyyəti</th>
                    <td colspan="2">{{$order->status}}</td>
                </tr>

            </table>
        </div>
    </div>
@endsection