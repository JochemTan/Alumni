@extends('layouts.login')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@endsection
@section('content')
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form form class="form-horizontal" role="form" method="POST" action="/alumnus/login">
                    {{ csrf_field() }}
                    @include('sessions.success')
                    <fieldset>
                        <img src="/images/logo.png" class="logo img-responsive">
                       
                        <div class="content">
                            {{-- <p class="header">Alumnus Login</p> --}}
                            <p class="header">Login als alumnus</p>
                            <div class="loginfield {{ $errors->has('email') ? ' has-error' : '' }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">

                               	 {{ $errors->first('email') }}
                            	</span>
                                @endif
                                {{-- <label for="email">Email</label> --}}
                                <input type="email" name="email" id="email" autocomplete="off" class="form-control"
                                       value="{{ old('email') }}" placeholder="Email">
                            </div>
                            <input type="submit" value="Send email">
                            <p class="text-center">
                                Medewerker Windesheim? <br>
                                <a href="/login">Klik hier om in te loggen.</a>
                            </p>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    @include('sessions.alert')

@endsection