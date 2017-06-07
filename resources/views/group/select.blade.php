@extends('layouts.app')
@section('nav')
    @include('layouts.nav.header2')
@endsection
@section('css')
    {{--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link href="/css/group/groupList.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @foreach($groupMembers as $member)
            <div class="col-md-2">
                <div class="alumnus">
                    @if($member->profile_image)
                    <img src="/images/alumnus/{{$member->profile_image}}">
                    @else
                    <img src="/images/alumnus/no-profile-pic.png">
                    @endif

                    <p class="name" data-toggle="tooltip" data-placement="bottom" title="{{$member->firstname." ".$member->insertion." ".$member->lastname}}">{{$member->firstname." ".$member->insertion." ".$member->lastname}}</p>
                    <p data-toggle="tooltip" data-placement="bottom" title="{{$member->education}}">{{$member->education}}</p>

                    <a href="/alumnusProfile/{{$member->id}}">
                        <button href="">Bekijk</button>
                    </a>
                        <br>
                    <div>
                        <p class="year pull-right">{{$member->graduationYear}}</p>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <br>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection