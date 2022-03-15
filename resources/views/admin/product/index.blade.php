@extends('admin.layouts.master')
@section('title','Product managment')
@section('content')
<h1 class="page-header">Product management</h1>
<h3 class="sub-header">Product List</h3>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{route('admin.product.new')}}" class="btn btn-primary">Create new product</a>
        </div>
        <form method="post" action="{{route('admin.product')}}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Product name"
                value="{{old('search')}}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{route('admin.product')}}" class="btn btn-primary">Clean</a>
        </form>
    </div>
@include('layouts.partials.alert')
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Slug</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Created At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($list) == 0)
            <tr><td colspan="7" class="text-center">Product not found !</td></tr>
            @endif
            @foreach ($list as $product)          
                <tr>
                    <td>{{$product->id}}</td>
                    <td>
                        <img src="{{$product->detail->product_image != null ? asset('/uploads/products/'.$product->detail->product_image) : 'http://via.placeholder.com/120x120/?text=Product Image'}}" alt="" style="width:120px">
                    </td>
                    <td>{{$product->slug}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td> {{$product->created_at->format('d/m/Y') }}</td>
                    <td style="width: 100px">
                        <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{route('admin.product.delete',$product->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')">
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