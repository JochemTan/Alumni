    {{--docent--}}
@if(Auth::user()->role_id == 1)
	@include('layouts.nav.docentHeader')
    {{--opleidingshoofd--}}
@elseif(Auth::user()->role_id == 2)
	@include('layouts.nav.header2')
    {{--communicatie--}}
@elseif(Auth::user()->role_id == 3)
    @include('layouts.nav.communicatie')
    {{--admin--}}
@elseif(Auth::user()->role_id == 4)
	@include('layouts.nav.header2')
@elseif(Auth::user()->role_id == 5)
    @include('layouts.nav.header2')

@endif