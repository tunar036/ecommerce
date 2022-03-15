@extends('admin.layouts.master')
@section('title','Product edit Form')
@section('content')
    <h1 class="page-header">Product management</h1>
    <form enctype="multipart/form-data" method="POST" action="{{route('admin.product.update',$product->id)}}">
        @csrf

        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
        <h2 class="sub-header">Product update form</h2>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Product name</label>
                    <input type="text" class="form-control" id="product" name="name" placeholder="Product name" value="{{$product->name}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Product slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{$product->slug}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="desc">Description</label>
                    <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" value="{{$product->desc}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">Product price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{$product->price}}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="1" name="show_slider" {{($product->detail->show_slider) ? 'checked' : ''}}> show slider
            </label>
            <label>
                <input type="checkbox" value="1" name="show_opportunity" {{($product->detail->show_opportunity) ? 'checked' : ''}}> show opportunity
            </label>
            <label>
                <input type="checkbox" value="1" name="show_featured" {{($product->detail->show_featured) ? 'checked' : ''}}> show featurde
            </label>
            <label>
                <input type="checkbox" value="1" name="show_bestselling" {{($product->detail->show_bestselling) ? 'checked' : ''}}>  show bestselling 
            </label>
            <label>
                <input type="checkbox" value="1" name="show_discount" {{($product->detail->show_discount) ? 'checked' : ''}}> show discount 
            </label>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="categories">Categories</label>
                    <select name="categories[]" id="categories" class="js-example-basic-multiple form-control" multiple>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{collect($product_categories)->contains($category->id) ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            @if ($product->detail->product_image != null)
                <img src="/uploads/products/{{$product->detail->product_image}}" alt="" style="width: 100px ; margin-right: 20px" class="thumbnail pull-left">
            @endif
            <label for="product_image">Product Image</label>
            <input type="file" name="product_image" id="product_image">
        </div>
    </form>
@endsection


@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('footer')
    {{-- <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function(){
            $('#categories').select2({
                placeholder: 'Please select category'
            });
            // CKEDITOR.replace('desc');
        });
    </script>
@endsection