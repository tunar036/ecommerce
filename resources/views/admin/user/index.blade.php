@extends('admin.layouts.master')
@section('title','User managment')
@section('content')
<h1 class="page-header">User management</h1>
<h3 class="sub-header">User List</h3>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{route('admin.user.new')}}" class="btn btn-primary">Create new user</a>
        </div>
        <form method="post" action="{{route('admin.user')}}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Name ,email search"
                value="{{old('search')}}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{route('admin.user')}}" class="btn btn-primary">Clean</a>
        </form>
    </div>
@include('layouts.partials.alert')
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name/Surname</th>
                <th>Email</th>
                <th>Is Active</th>
                <th>Is Admin</th>
                <th>Created At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($list) == 0)
            <tr><td colspan="7" class="text-center">User not found !</td></tr>
            @endif
            @foreach ($list as $user)         
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if ($user->is_active)
                            <span class="label label-success">Active</span>
                        @else
                            <span class="label label-warning">Passive</span>
                        @endif
                    </td>
                    <td>
                        @if ($user->is_admin)
                            <span class="label label-success">Admin</span>
                        @else
                            <span class="label label-warning">User</span>
                        @endif
                    </td>
                    <td> {{$user->created_at->format('d/m/Y') }}</td>
                    <td style="width: 100px">
                        <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{route('admin.user.delete',$user->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')">
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