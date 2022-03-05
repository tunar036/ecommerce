@extends('admin.layouts.master')
@section('title','Category managment')
@section('content')
<h1 class="page-header">Category management</h1>
<h3 class="sub-header">Category List</h3>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{route('admin.category.new')}}" class="btn btn-primary">Create new category</a>
        </div>
        <form method="post" action="{{route('admin.category')}}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Category name"
                value="{{old('search')}}">
                <label for="up_id">Up category</label>
                <select name="up_id" id="up_id" class="form-control">
                    <option value="">Choose</option>
                    @foreach ($up_categories as $up_category)
                        <option value="{{$up_category->id}}" {{old('up_id') == $up_category->id ? 'selected' : ''}}>{{$up_category->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{route('admin.category')}}" class="btn btn-primary">Clean</a>
        </form>
    </div>
@include('layouts.partials.alert')
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Up Category</th>
                <th>Slug</th>
                <th>Category name</th>
                <th>Created At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($list) == 0)
            <tr><td colspan="6" class="text-center">Category not found !</td></tr>
            @endif
            @foreach ($list as $category)         
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->up_category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td>{{$category->name}}</td>
                    <td> {{$category->created_at->format('d/m/Y') }}</td>
                    <td style="width: 100px">
                        <a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{route('admin.category.delete',$category->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')">
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