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
        <form method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="opleiding">Opleidings naam</label>
                <input type="text" class="form-control" name="opleiding">
            </div>
            <button type="submit" formaction="/education/create" class="btn btn-default">Submit</button>
        </form>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Opleiding</th>
                <th>Gemaakt op</th>
            </tr>
            </thead>
            <tbody>
            @foreach($educations as $education)
                <tr>
                    <td>{{$education->name}}</td>
                    <td>{{$education->created_at}}</td><!-- comment: 1 -->

                </tr>
            @endforeach
            </tbody>

        </table>
        {{$educations->links()}}
    </div>
@endsection