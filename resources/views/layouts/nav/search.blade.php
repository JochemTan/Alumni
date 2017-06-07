<?php
use App\Filters;

?>
@extends('layouts.nav.header2')
<link rel="stylesheet" href="/css/searchnav.css">
@section('subHeader')
    {{--<div id="tabs" class="row">--}}
    <div id="tabHeader">
        <div id="tabs" class="container">
            <ul class="nav nav-tabs">
                <li {{ (Request::is('search') ? 'class=active' : '') }} >
                    <a href="/search?{{Filters::String()}}">Lijst</a>
                </li>
                <li {{ (Request::is('graphs') ? 'class=active' : '') }} >
                    <a href="/graphs?{{Filters::String()}}">Statistieken</a>
                </li>
            </ul>
        </div>
    </div>
    {{--<div>--}}
@endsection