<?php
use App\Filters;
?>
@extends('layouts.app')
@section('title','Zoeken')
@section('nav')
    @include('restrictions.search')
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/search.css">
    <link rel="stylesheet" href="/css/overview.css">
@endsection
@section('content')
    <form method="post" id="resultsFrom">
    <div class="container" style="margin-top: 100px;">
        {{--OVERVIEW--}}
        <div class="col-md-12">
            <div class="scrollable-table">
                {{$numTotal." resultaten in ".$duration . " seconden"}}
                    {{ csrf_field() }}
                    <table class="table table-filter">
                        <tbody>
                        <tr>
                            <td>
                                <div class="ckbox">
                                    <input type="checkbox" id="checkAll">
                                    <label for="checkAll"></label>
                                </div>
                            </td>
                            <td>

                            </td>
                        </tr>
                        @foreach($alumni as $alumnus)
                            <tr>
                                <td>
                                    <div class="ckbox">
                                        <input type="checkbox" class="bulk-checkbox"
                                               id="checkbox {{ $alumnus->id }}" name="{{ $alumnus->id }}">
                                        <label for="checkbox {{ $alumnus->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="media">
                                        <a href="#" class="pull-left">
                                            @if($alumnus->profile_image)
                                                <img alt="User Pic" src="/images/alumnus/{{$alumnus->profile_image}}" class="media-photo img-circle">
                                            @else
                                                <img alt="User Pic" src="/images/alumnus/no-profile-pic.png" class="media-photo img-circle">
                                            @endif
                                        </a>
                                        <p class="media-meta pull-right" title="Afstudeerjaar">
                                            {{$alumnus->graduationYear}}</br>
                                        </p>
                                        <div class="media-body">
                                            <a href="/alumnusProfile/{{$alumnus->id}}">
                                                <h4 class="title">
                                                    {{$alumnus->name() .' - '. $alumnus->place }}
                                                </h4>
                                            </a>
                                            <p class="summary">
                                                {{ $alumnus->dateToYear() }} Jaar</br>
                                                {{ $alumnus->education }}</br>
                                                {{ $alumnus->function }}</br>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="pull-left" style="margin-top: -22px">{{ $alumni->appends(Filters::String())->links() }}</div>
        </div>
    </div>
@endsection
@section('footer')
    <footer>
        <div class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="container">
                @if(Auth::user()->role_id != 1)
                    <label class="col-md-1">Groep</label>
                    <select title="groep" name="group" class="selectpicker col-md-3" style="">
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                    </select>
                @endif

                <div id="footer-btn-group" class="btn-group btn-group-justified" role="group" aria-label="...">
                    @if(Auth::user()->role_id != 1)
                        <div class="btn-group" role="group">
                            <button type="submit" formaction="/group/add" form="resultsFrom" class="btn btn-default">Toevoegen aan</button>
                        </div>
                    @endif
                    <div class="btn-group" role="group">
                        <button form="resultsFrom" formaction="/mail?{{\App\Filters::String()}}" type="submit" class="btn btn-default">
                            <i class="glyphicon glyphicon-envelope"></i> Mail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </form>
@endsection
@section('js')


    <script>
        $("#checkAll").click(function () {
            $('.bulk-checkbox').not(this).prop('checked', this.checked);
        });

        function getATxt() {
            var ary = [];
            $('.bulk-checkbox:checked').each(function () {
                ary.push($(this).attr('id'));
            });
            $("a#mylink").attr("href", ary.join("=&"));
            console.log(ary);
        }

        $('.bulk-checkbox').change(function () {
            getATxt();
        });
        //@ startup
        getATxt();
    </script>
@endsection
