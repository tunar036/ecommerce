@extends('layouts.master')
@section('title','Login')
@section('content')
<div class="container">
@include('layouts.partials.alert')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Daxil ol</div>
                    <div class="panel-body">
                        @include('layouts.partials.errors')
                        <form class="form-horizontal" role="form" method="POST" action="{{route('user.login')}}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="sifre" class="col-md-4 control-label">Şifrə</label>
                                <div class="col-md-6">
                                    <input id="sifre" type="password" class="form-control" name="password" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember_me" checked> Məni xatırla
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Giriş yap
                                    </button>
    
                                    <a class="btn btn-link" href="">
                                        Şifremi Unuttum
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection