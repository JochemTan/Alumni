@extends('layouts.login')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
@endsection
@section('content')
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <fieldset>
                        <img src="/images/logo.png" class="logo img-responsive">
                        <div class="content">

                            <div class="loginfield {{ $errors->has('email') ? ' has-error' : '' }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                {{ $errors->first('email') }}
                            </span>
                                @endif
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" autocomplete="off" class="form-control"
                                       value="{{ old('email') }}">
                            </div>
                            <div class="loginfield {{ $errors->has('email') ? ' has-error' : '' }}">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                {{ $errors->first('password') }}
                            </span>
                                @endif
                                <label for="password">Wachtwoord</label>
                                <input type="password" id="password" name="password" class="form-control"
                                       value="{{ old('password') }}">
                            </div>
                            <input type="submit" name="submit" value="Log In">
                            <p class="text-center">
                                Alumnus Windesheim? <br>
                                <a href="/alumnus/login">Klik hier om in te loggen.</a>
                            </p>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
