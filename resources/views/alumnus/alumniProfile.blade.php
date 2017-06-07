@extends('layouts.app')
@section('nav')
    @if(Auth::user())
        @include('layouts.nav.header2')
    @else
        @include('layouts.nav.alumnus')
    @endif
@endsection
@section('css')
    <link rel="stylesheet" href="/css/alumniProfile.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection
@section('content')
    <div class="container" style="margin-top:55px;">
        <h2>{{$alumnus->firstname. " " .$alumnus->insertion. " " .$alumnus->lastname}}</h2>
        <hr>
        <div class="row">
            <p>
            </p>
            <div class="col-xs-12 col-md-2">
                @if($alumnus->profile_image)
                    <img alt="User Pic" src="/images/alumnus/{{$alumnus->profile_image}}" class="img-responsive">
                @else
                    <img alt="User Pic" src="/images/alumnus/no-profile-pic.png" class="img-responsive">
                @endif
            </div>
            @if(Auth::user())
                <div class="col-xs-12 col-md-2">
                    <div class="btn-group" role="group">
                    <button form="alumnusEmail" formaction="/mail?alumnusName={{$alumnus->firstname}}&alumnusEmail={{$alumnus->email}}" type="submit" class="btn btn-default">
                        <i class="glyphicon glyphicon-envelope"></i> Mail
                    </button>
                </div>
                </div>
            @else
                <div class="col-xs-12 col-md-2">
                    <a href="/alumnus/edit"><button type="button" class="btn profile profile-blue">Profiel wijzigen</button></a>
                    <p></p>
                    {{--<button form="alumnusEmail" formaction="/mail?opleidingshoofdName[]=&opleidingshoofdEmail={{$oh[0]->email}}" type="submit" class="btn btn-default">--}}
                        {{--<i class="glyphicon glyphicon-envelope"></i> Mail--}}
                    {{--</button>--}}
                    @if(strlen($link) > 0)
                    <button title="Mail opleidingshoofd" form="alumnusEmail" formaction="/mail?{{$link}}" class="btn btn-default">
                        <i class="glyphicon glyphicon-envelope"></i> Mail
                    </button>
                    @endif
                </div>
               {{-- <div class="col-xs-12 col-md-4">
                   
               </div>
               <div class="col-xs-12 col-md-4">
                   switches will be placed here
               </div> --}}
            @endif
            <div class="col-xs-12 col-md-4">
                   
            </div>
            @if(Auth::user())

            @else
            <div class="col-xs-12 col-md-4">
               <h4>Settings</h4>
                <div class="checkers">
                    <p class='labeltext'>Ik wil een gastcollege geven</p>
                   <div class="material-switch pull-right">
                            
                            @if($alumnus->guestlecture == 1)
                                <i class="ion-checkmark-round green"></i>
                            @else
                                <i class="ion-close-round red"></i>
                            @endif
                    </div>

                </div>
                <div class="checkers">
                    <p class='labeltext'>Ontvang een maandelijkse nieuwsbrief</p>
                   <div class="material-switch pull-right">
                            @if($alumnus->newsletter == 1)
                                <i class="ion-checkmark-round"></i>
                            @else
                                <i class="ion-close-round"></i>
                            @endif
                    </div>
                    
                </div>
                <div class="checkers">
                    <p class='labeltext'>Gegevens  worden alleen voor statistieken gebruikt</p>
                   <div class="material-switch pull-right">
                           @if($alumnus->prive == 1)
                                <i class="ion-checkmark-round"></i>
                            @else
                                <i class="ion-close-round"></i>
                            @endif
                    </div>
                    
                </div>


            </div>
            @endif
        </div>

        <br>
        <hr>
        <br>

        <div class="row alumnusProfile">
            <div class="col-xs-12 col-md-4">
                <h4>Persoonlijke gegevens</h4>
                <hr>

                <b>Voornaam:</b>
                <p>{{$alumnus->firstname}}</p>

                <b>Tussenvoegsel:</b>
                <p>{{$alumnus->insertion}}</p>

                <b>Achternaam:</b>
                <p>{{$alumnus->lastname}}</p>
                <form id="alumnusEmail" method="post">
                    {{ csrf_field() }}
                    <b>Email:</b>   
                    <p>{{$alumnus->email}}</p>
                </form>
                @if($alumnus->prive == 1)
                    <b>Postcode:</b>
                    <p>{{$alumnus->postalcode}}</p>
                @endif
                <b>linkedIn:</b>
                <a href="{{$alumnus->linkedIn}}">
                    <p>{{$alumnus->linkedIn}}</p>
                </a>
            </div>
            <div class="col-xs-12 col-md-4">
                <h4>Bedrijfs gegevens</h4>
                <hr>
                @if($alumnus->company_id)
                    <b>Bedrijf:</b>
                    <p>{{$alumnus->company->name}}</p>

                    <b>Postcode:</b>
                    <p>{{$alumnus->company->postalcode}}</p>


                    <b>Functie:</b>
                    <p>{{$alumnus->function}}</p>

                    <b>Sector:</b>
                    <p>{{$alumnus->company->sector}}</p>

                    <b>Beschrijving:</b>
                    <p>{{$alumnus->company->description}}</p>
                @else
                    <br>
                    <p>Geen bedrijf gegevens</p>
                @endif
            </div>
            <div class="col-xs-12 col-md-4">
                <h4>Opleidings gegevens</h4>
                <hr>

                <b>Opleiding:</b>
                <p>{{$alumnus->education}}</p>

                <b>Afgestudeerd:</b>
                <p>{{$alumnus->graduationYear}}</p>
            </div>
        </div>
    </div>
@endsection
