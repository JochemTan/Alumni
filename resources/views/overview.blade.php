@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/overview.css">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <section class="content">
                <h1>Alumni overzicht</h1>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-container">
                                    <form action="/mail" method="post">
                                        {{ csrf_field() }}
                                    <table class="table table-filter">
                                        <tbody>
                                        @foreach($alumni as $alumnus)
                                            <tr>
                                                <td>
                                                    <div class="ckbox">
                                                        <input type="checkbox" id="checkbox {{ $alumnus->id }}" name="{{ $alumnus->id }}">
                                                        <label for="checkbox {{ $alumnus->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <a href="#" class="pull-left">
                                                            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg"
                                                                 class="media-photo img-circle"/>
                                                        </a>
                                                        <p class="media-meta pull-right">
                                                            {{$alumnus->graduationYear}}</br>
                                                        </p>
                                                        <div class="media-body">
                                                            <h4 class="title">
                                                                {{ $alumnus->firstname .' '. $alumnus->insertion .' '. $alumnus->lastname .' - '. $alumnus->place}}
                                                            </h4>
                                                            <p class="summary">
                                                                {{ $alumnus->birthday->y }} Jaar</br>
                                                                {{ $alumnus->education }}</br>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-sm btn-primary pull-right">
                                        <i class="glyphicon glyphicon-envelope"></i> Mail
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection