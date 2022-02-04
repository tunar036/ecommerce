@extends('layouts.master')
@section('title','Sign Up')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Qeydiyyat</div>
                    <div class="panel-body">
                        @include('layouts.partials.errors')
                        <form class="form-horizontal" role="form" method="POST" action="{{route('user.signup')}}">
                        @csrf
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Ad və Soyad</label>
                                <div class="col-md-6">
                                    <input id="Ad" type="text" class="form-control" name="name" value="{{old('name')}}" required autofocus>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Şifrə</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Şifrə (Təkrar)</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                    Qeydiyyatdan keçin
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection