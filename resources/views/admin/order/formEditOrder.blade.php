@extends('admin.layouts.master')
@section('title','Order edit Form')
@section('content')
    <h1 class="page-header">Order management</h1>
    <form method="POST" action="{{route('admin.category.update', $order->id)}}">
        @csrf

        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
        <h2 class="sub-header">Order update form</h2>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">User name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="User name" value="{{ $order->name}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ $order->phone}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ $order->address}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="" {{$order->status == 'Sifarishiniz alindi' ? 'selected' : '' }}>Sifarishiniz alindi</option>
                    <option value="" {{$order->status == 'Odenish tesdiqlendi' ? 'selected' : '' }}>Odenish tesdiqlendi</option>
                    <option value="" {{$order->status == 'Kargoya verildi' ? 'selected' : '' }}>Kargoya verildi</option>
                    <option value="" {{$order->status == 'Sifarish tamamlandi' ? 'selected' : '' }}>Sifarish tamamlandi</option>
                </select>
            </div>
            </div>
        </div>
    </form>
@endsection