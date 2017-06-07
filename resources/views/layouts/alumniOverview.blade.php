<style>

    h1,h2,h3,h4,h5,h6,p {
        margin: 0px;
    }

    a {
        all: unset;
        color: #2BBCDE;
    }

    a:hover  {
        color: #9fcad4 !important;
        text-decoration: none;
    }

    .row {
        margin: 0px;
        margin-bottom: 5px;
    }

    .row:nth-child(odd) {
        background-color: #f8f8f8;
    }

    img.profile {
        /*border: 1px solid black;*/
        max-width: 100px !important;
        border-radius: 5px;
        margin: 5px;
    }

    .information {
        margin-top: 20px;
        margin-bottom: 5px;
    }

</style>

@foreach($alumni as $alumnus)
    <div class="row">
        <div class="col-xs-12 col-md-4">
            @if($alumnus->profile_image)
                <img class="profile" src="/images/alumnus/{{$alumnus->profile_image}}">
            @else
                <img class="profile" src="/images/alumnus/no-profile-pic.png">
            @endif
        </div>

        <div class="col-xs-12 col-md-6 information">
            <a href="/alumnus/{{$alumnus->id}}">
                <h4>{{$alumnus->firstname." ".$alumnus->insertion." ".$alumnus->lastname}}</h4>
            </a>

            <p>{{$alumnus->education.": ".$alumnus->graduationYear}}</p>
            <p>{{$alumnus->function}}</p>
        </div>
    </div>
@endforeach