@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/customnav2.css">
@endsection
@section('nav')
    @include('layouts.nav.header2')
    {{-- @include('restrictions.level') --}}
    
@endsection
@section('content')
<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        @if(Auth::user()->role_id == 3)
            <form action="/email/sendyearly" method="get">
         
            <input type="submit" name="submit" class="btn btn-success" value="verstuur email">
        </form>

        @endif
            </div>
        </div>
    </div>
</div>
@endsection
