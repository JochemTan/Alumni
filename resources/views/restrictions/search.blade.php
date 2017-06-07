<?php $role_id = Auth::user()->role_id; ?>
    {{--docent--}}
@if($role_id == 1)
	@include('layouts.nav.header2')
    {{--opleidingshoofd & admin--}}
@elseif($role_id == 2 || $role_id == 4 ||$role_id == 5)
	@include('layouts.nav.search')
@endif