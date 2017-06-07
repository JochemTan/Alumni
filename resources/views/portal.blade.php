@extends('layouts.app')
@section('content')

<div class="row">
    <div class="container">
            <div class="span7 text-center">
                <div>
                    <img src="/images/logo.png" class="logo img-responsive center-block" style= "padding: 1rem;">
                </div>
                <br>
                <h4>
                    Geef aan wie je bent
                </h4>
                <div class="btn-group-vertical">
                    <a id = "alumnusButton" type="button" class="btn btn-default" href="/alumnus/login"> Alumnus</a>
                    <a id = "employeeButton" type="button" class="btn btn-default" href="/home"> Werknemer windesheim</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@yield('javascript')
</body>
