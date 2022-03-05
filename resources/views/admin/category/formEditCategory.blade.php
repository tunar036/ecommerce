@extends('admin.layouts.master')
@section('title','Category edit Form')
@section('content')
    <h1 class="page-header">Category management</h1>
    <form method="POST" action="{{route('admin.category.update', $category->id)}}">
        @csrf

        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
        <h2 class="sub-header">Category update form</h2>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="up_id">Up Category name</label>
                    <select name="up_id" id="up_id" class="form-control">
                        @foreach ($allcategories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Category name</label>
                    <input type="text" class="form-control" id="category" name="name" placeholder="Category name" value="{{ $category->name}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="slug">Category slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{$category->slug}}">
                </div>
            </div>
        </div>
    </form>
@endsection