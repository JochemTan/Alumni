<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a href="/home" class="navbar-brand">
                    <img src="/images/windesheimlogo.png" class="logo" alt="Windesheim">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{-- {{'hardcoded'}} --}}
                                @if(Auth::user())
                                    {{ Auth::user()->firstname }}
                                @else
                                    {{ Auth::guard('alumnus')->user()->firstname }}
                                @endif
                                <span class="caret"></span>
                                 {{--{{ Auth::guard('alumnus')->user()->firstname }}  <span class="caret"></span>--}}
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/alumnus/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                </ul>
            </div>
        </div>
    </nav>