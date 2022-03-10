@extends('admin.layouts.master')
@section('title','Product create Form')
@section('content')
    <h1 class="page-header">Product management</h1>
    <form method="POST" action="{{route('admin.product.save')}}">
        @csrf

        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
        <h2 class="sub-header">Product create form</h2>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Product name</label>
                    <input type="text" class="form-control" id="product" name="name" placeholder="Product name" value="{{old('name')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Product slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{old('slug')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="desc">Description</label>
                    <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" value="{{old('slug')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">Product price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{old('slug')}}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="1" name="show_slider" > show slider
            </label>
            <label>
                <input type="checkbox" value="1" name="show_opportunity" > show opportunity
            </label>
            <label>
                <input type="checkbox" value="1" name="show_featured" > show featurde
            </label>
            <label>
                <input type="checkbox" value="1" name="show_bestselling" >  show bestselling 
            </label>
            <label>
                <input type="checkbox" value="1" name="show_discount" > show discount 
            </label>
        </div>
    </form>
@endsection