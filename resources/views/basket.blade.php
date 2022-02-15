@extends('layouts.master')
@section('title','Basket')
@section('content')
<div class="container">
        <div class="bg-content">
            <h2>Səbət</h2>
            @include('layouts.partials.alert')

            @if(count(Cart::content()) > 0)
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Məhsul</th>
                    <th>Ədəd qiyməti</th>
                    <th>Ədəd</th>
                    <th>Məbləğ</th>
                </tr>
                @foreach(Cart::content() as $productCartItem)
                <tr>
                    <td style="width: 120px;"> 
                        <a href="{{route('product',$productCartItem->options->slug)}}">
                            <img src="http://via.placeholder.com/120x100?text=Product Image"> 
                        </a>
                    </td>
                    <td>
                        <a href="{{route('product',$productCartItem->options->slug)}}">
                            {{$productCartItem->name}}
                        </a>
                        <form action="{{route('delete.basket',$productCartItem->rowId)}}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <input type="submit" class="btn btn-danger btn-xs" value="Səbətdən sil">
                        </form>
                    </td>
                    <td>{{$productCartItem->price}} manat</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default product-piece-reduce" data-id="{{$productCartItem->rowId}}" data-piece="{{$productCartItem->qty-1}}">-</a>
                        <span style="padding: 10px 20px">{{$productCartItem->qty}}</span>
                        <a href="#" class="btn btn-xs btn-default product-piece-increase" data-id="{{$productCartItem->rowId}}" data-piece="{{$productCartItem->qty+1}}">+</a>
                    </td>
                    <td class="text-right">
                        {{$productCartItem->subtotal}} manat
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Toplam(ƏDV-siz)</th>
                    <td class="text-right">{{Cart::subtotal()}} manat</td>
                </tr>                
                <tr>
                    <th colspan="4" class="text-right">ƏDV</th>
                    <td class="text-right">{{Cart::tax()}} manat</td>
                </tr>                
                <tr>
                    <th colspan="4" class="text-right">CƏM</th>
                    <td class="text-right">{{Cart::total()}} manat</td>
                </tr>
            </table>
            <form action="{{route('empty.basket')}}" method="POST">
                @csrf
                {{ method_field('DELETE')}}
                <input type="submit" class="btn btn-info pull-left" value="Səbəti boşalt">
            </form>
            <a href="#" class="btn btn-success pull-right btn-lg">Ödəniş et</a>
            @else
                <p>Səbətinizdə məhsul yoxdur !</p>
            @endif
        </div>
    </div>
@endsection

@section('footer')
<script>
    $(function () {
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $('.product-piece-reduce, .product-piece-increase').on('click',function(){
            var id = $(this).attr('data-id');
            var piece = $(this).attr('data-piece');
            $.ajax({
                type: 'PATCH',
                url: "{{ url('basket/update')}}/" + id,
                data: {piece: piece},
                success: function(){
                    window.location.href = "{{route('basket')}}";
                }
            })
        })

    })
</script>
@endsection