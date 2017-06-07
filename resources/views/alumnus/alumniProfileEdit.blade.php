@extends('layouts.app')
@section('nav')
    @include('layouts.nav.alumnus')
@endsection
@section('css')
    <link rel="stylesheet" href="/css/alumniProfile.css">
@endsection
@section('content')
    <div class="container" style="margin-top:55px;">
        <form method="post" action="/alumnus/edit{{$alumnus->id}}" enctype="multipart/form-data">
            {{csrf_field()}}

        <h2>{{$alumnus->firstname. " " .$alumnus->insertion. " " .$alumnus->lastname}}</h2>
        <hr>
        <div class="row">
            <div class="col-xs-12 col-md-2">
                @if($alumnus->profile_image)
                    <img alt="User Pic" id="profilePick" src="/images/alumnus/{{$alumnus->profile_image}}" class="img-responsive">
                @else
                    <img alt="User Pic" id="profilePick" src="/images/alumnus/no-profile-pic.png" class="img-responsive">
                @endif
            </div>

            <div class="col-xs-12 col-md-2">
                <label class="input btn profile profile-blue">
                    <input type="file" id="imgInp" name="profileImage"/>
                    <span>Upload foto</span>

                </label>

                <div>
                    <br>
                    <button type="submit" class="profile profile-green">Opslaan</button>
                </div>

            </div>
            <div class="col-xs-12 col-md-4">
                   
            </div>
            <div class="col-xs-12 col-md-4">
               <h4>Settings</h4>
                <div class="checkers">
                    <p class='labeltext'>Ik wil een gastcollege geven</p>
                   <div class="material-switch pull-right">
                            <input id="gastcollege" name="guestlecture" value="1" type="checkbox"
                            @if($alumnus->guestlecture == 1)
                                checked
                            @else
                            @endif
                            />
                            <label for="gastcollege" class="label-primary"></label>
                    </div>

                </div>
                <div class="checkers">
                    <p class='labeltext'>Ontvang een maandelijkse nieuwsbrief</p>
                   <div class="material-switch pull-right">
                            <input id="nieuwsbrief" name="newsletter" type="checkbox" value="1" 
                            @if($alumnus->newsletter == 1)
                                checked
                            @else
                            @endif
                            />
                            <label for="nieuwsbrief" class="label-primary"></label>
                    </div>
                    
                </div>
                <div class="checkers">
                    <p class='labeltext'>Gegevens zijn prive</p>
                   <div class="material-switch pull-right">
                        <input id="privegegevens" name="private" value="1" type="checkbox"
                        @if($alumnus->prive == 1)
                            checked
                        @else
                        @endif
                        />
                        <label for="privegegevens" class="label-primary"></label>
                   </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="row alumnusProfile">
            <div class="col-xs-4">
                <h4>Persoonlijke gegevens</h4>
                <hr>

                <b>Voornaam:</b>
                <input name="firstname" required value="{{$alumnus->firstname}}">
                <br>

                <b>Tussenvoegsel:</b>
                <input name="insertion" value="{{$alumnus->insertion}}">
                <br>

                <b>Achternaam:</b>
                <input name="lastname" required value="{{$alumnus->lastname}}">

                <b>Email:</b>
                <input name="email" required value="{{$alumnus->email}}">

                <b>Postcode:</b>
                <input name="postalcode" value="{{$alumnus->postalcode}}">

                <b>linkedIn:</b>
                <input name="linkedIn" value="{{$alumnus->linkedIn}}">

            </div>
            <div class="col-xs-4">
                <h4>Bedrijfs gegevens</h4>
                <hr>


                    @if($alumnus->company)
                    <b>Bedrijf:</b>
                    <input name="company_name" value="{{$alumnus->company->name}}">

                    <b>Postcode:</b>
                    <input name="company_postalcode" value="{{$alumnus->company->postalcode}}">

                    <b>Functie:</b>
                    <input name="function" value="{{$alumnus->function}}">

                    <b>Sector:</b>
                    <input name="company_sector" value="{{$alumnus->company->sector}}">

                    <b>Beschrijving:</b>
                    <input name="company_description" value="{{$alumnus->company->description}}">
                    @else
                    <b>Bedrijf:</b>
                    <input name="company_name">

                    <b>Postcode:</b>
                    <input name="company_postalcode">

                    <b>Functie:</b>
                    <input name="function">

                    <b>Sector:</b>
                    <input name="company_sector">

                    <b>Beschrijving:</b>
                    <input name="company_description">
                    @endif

            </div>
            <div class="col-xs-4">
                <h4>Opleidings gegevens</h4>
                <hr>

                <b>Opleiding:</b>
                <p>{{$alumnus->education}}</p>

                <b>Afgestudeerd:</b>
                <p>{{$alumnus->graduationYear}}</p>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection

@section('extraJs')
    <script src="/js/alumnusProfile/previewProfile.js"></script>
@endsection
