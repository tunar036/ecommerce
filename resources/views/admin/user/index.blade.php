@extends('admin.layouts.master')
@section('title','User')
@section('content')
<h1 class="page-header">User management</h1>
<h1 class="sub-header">
    <div class="btn-group pull-right" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-primary">Print</button>
        <button type="button" class="btn btn-primary">Export</button>
    </div>
    User List
</h1>
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
                        <a href="#" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection