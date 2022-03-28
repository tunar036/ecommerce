@extends('admin.layouts.master')
@section('title','Product managment')
@section('content')
<h1 class="page-header">Order management</h1>
<h3 class="sub-header">Order List</h3>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{route('admin.order.new')}}" class="btn btn-primary">Create new order</a>
        </div>
        <form method="post" action="{{route('admin.order')}}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Product name"
                value="{{old('search')}}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{route('admin.order')}}" class="btn btn-primary">Clean</a>
        </form>
    </div>
@include('layouts.partials.alert')
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Order code</th>
                <th>User name</th>
                <th>Order Amount</th>
                <th>Order Status</th>
                <th>Created At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($list) == 0)
            <tr><td colspan="7" class="text-center">Product not found !</td></tr>
            @endif
            @foreach ($list as $order)          
                <tr>
                    <td>SP-{{$order->id}}</td>
                    <td>{{$order->basket->user->name}}</td>
                    <td>{{$order->order_amount * ((100 + config('cart.tax')) / 100)}} m </td>
                    <td>{{$order->status}}</td>
                    <td> {{$order->created_at->format('d/m/Y') }}</td>
                    <td style="width: 100px">
                        <a href="{{route('admin.order.edit',$order->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{route('admin.order.delete',$order->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$list->links()}}
</div>

@endsection