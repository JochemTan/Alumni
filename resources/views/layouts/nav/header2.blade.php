<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="/css/customnav2.css">
<?php $role_id = Auth::user()->role_id?>
<div class="navbar navbar-default navbar-fixed-top">
    <div id="navContainer" class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/home" class="navbar-brand">
                <img src="/images/windesheimlogo.png" class="logo" alt="Windesheim">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            @if($role_id == 1 || $role_id == 5)
                 <li><a href="/search">Alumni lijst</a></li>
            @elseif($role_id == 2)
                <li><a href="/groups">Groepen</a></li>
                <li><a href="/search">Lijst</a></li>
            @elseif($role_id == 3)
                <li><a href="#">Maak evenement aan (WIP)</a></li>
            @elseif($role_id == 4)
                <li><a href="/employees">Werknemers</a></li>
                <li><a href="/educations">Opleidingen</a></li>
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span  style="display: inline;" aria-expanded="false">Toevoegen
                                <i class="ion-chevron-down"></i>
                            </span>
                        </a>
                    <ul class="dropdown-menu">
                        <li><a href="/employee/create">Werknemer</a></li>
                        <li><a href="/alumnus/create">Alumnus</a></li>

                    </ul>
                </li>
            @endif
            </ul>
             @if($role_id == 1 ||$role_id == 2 || $role_id == 3 || $role_id == 5)
            <form class="navbar-form navbar-left" action="{{ (Request::is('graphs') ? '/graphs' : '/search') }}"
                  method="get">
                <div class="pnl">
                    <input id="searchField" type="text" name="searchTerm" placeholder="Search"
                           value="{{$searchTerm or ""}}"
                           autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                    <!--onfocus part sets the cursor at the end-->
                </div>
                <div class="slctpnl hidden-xs" id="filterButton">
                    <div class="ion-help-circled"></div>
                </div>
                <button type="submit" class="slctpnl search">
                    <p class="ion-search" aria-hidden="true"></p>
                </button>
                <div id="filterlist" class="filterlist">
                    <?php echo(App\Filters::Display()) ?>
                </div>
            </form>
            @endif
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <img src="/images/users/{{Auth::user()->image}}" alt="userimage" class="profile-image">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" style=" display: inline; " aria-expanded="false">
                        <span  style="display: inline;" aria-expanded="false">{{ Auth::user()->firstname }}
                            <i class="ion-chevron-down"></i>
                        </span>
                    </a>
                    @if($role_id == 2)
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/settings') }}">Verander gegevens</a></li>
                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                    @else
                    <ul class="dropdown-menu"> 
                        <li><a href="{{ url('/special/settings') }}">Persoonlijke gegevens</a></li> 
                        <li><a href="{{ url('/logout') }}">Logout</a></li> 
                    </ul> 
                    @endif
                </li>
            </ul>
        </div>
    </div>
    @yield('subHeader')
</div>