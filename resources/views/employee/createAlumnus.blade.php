@extends('layouts.app')
@section('title','Maak werknemer aan')
@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="/css/overview.css"> --}}
@endsection
@section('nav')
    @include('restrictions.level')
@endsection

@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('sessions.success')
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Voeg hier een nieuwe alumnus toe</h4></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="/alumnus/create/new">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="col-md-4 control-label">Voornaam</label>

                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control" name="firstname"
                                           value="{{ old('firstname') }}" required>

                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('insertion') ? ' has-error' : '' }}">
                                <label for="insertion" class="col-md-4 control-label">Tussenvoegsel</label>

                                <div class="col-md-6">
                                    <input id="insertion" type="text" class="form-control" name="insertion"
                                           value="{{ old('insertion') }}">

                                    @if ($errors->has('insertion'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('insertion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="col-md-4 control-label">Achternaam</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname"
                                           value="{{ old('lastname') }}" required>

                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail adres</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                <label for="Afstudeer jaar" class="col-md-4 control-label">Afstudeerjaar</label>

                            <div class="col-md-6">
                                {{-- <input id="graduationYear" type="text" class="form-control" name="graduationYear" value="{{ old('graduationYear') }}" required> --}}
                                <select name="graduationYear" class="form-control">
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                </select>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Opleiding</label>
                                <div class="col-md-6">
                                    <select name="education" class="form-control">
                                        @foreach($educations as $education)
                                            <option value="{{ $education->name }}">{{ $education->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Maak Alumnus aan
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