@extends('layouts.master')
@section('title','Orders')
@section('content')
<div class="container">
        <div class="bg-content">
            <h2>Sifarişlər</h2>
            @if(count($orders) == 0)
            <p>Hələ heç bir sifarişiniz yoxdur</p>
            @else
            <table class="table table-bordererd table-hover">
                <tr>
                    <th>Sifariş kodu</th>
                    <th>Məbləğ</th>
                    <th>Ümumi məhsul</th>
                    <th>Vəziyyət</th>
                    <th></th>
                </tr>
                @foreach($orders as $order)
                <tr>
                    <td>SP-{{$order->id}}</td>
                    <td>{{$order->order_amount * (100+config('cart.tax'))/100}}</td>
                    <td>{{$order->basket->basket_product_pieces}}</td>
                    <td>{{$order->status}}</td>
                    <td><a href="{{route('order',$order->id)}}" class="btn btn-sm btn-success">Detay</a></td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
@endsection