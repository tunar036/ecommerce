@extends('admin.layouts.master')
@section('title','User edit Form')
@section('content')
    <h1 class="page-header">User management</h1>
    <form method="POST" action="{{route('admin.user.save')}}">
        @csrf

        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
        <h2 class="sub-header">User create form</h2>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name/surname</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name / Surname" value="{{old('name')}}" name="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{old('address')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{old('phone')}}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="1" name="is_active" {{old('is_active')}}> is active ? 
            </label>
        </div>
        <div class="checkbox">
            <label>
               
                <input type="checkbox" value="1" name="is_admin" {{old('is_admin')}}> is admin ?
            </label>
        </div>
    </form>
@endsection