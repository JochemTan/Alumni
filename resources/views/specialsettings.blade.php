@extends('layouts.app')
@section('nav')
	{{-- @include('restrictions.level') --}}
	@include('layouts.nav.header2')
@endsection
@section('content')

	<style>
		#profilePick {
			max-width: 100px;
		}
	</style>

	<div class="container" style="margin-top: 100px;">
				<div class="col-md-6 col-md-offset-3">
				@include('sessions.success')
			<h3>Verander gegevens</h3>
			<br>
			<form action="/specialsettings/update" method="post" class="form-horizontal" enctype="multipart/form-data">
				{{ csrf_field() }}
				@if($user->image)
					<img alt="User Pic" id="profilePick" src="/images/users/{{$user->image}}" class="img-responsive">
				@else
					<img alt="User Pic" id="profilePick" src="/images/users/no-profile-pic.png" class="img-responsive">
				@endif

				<label class="input btn profile profile-blue">
					<input type="file" id="userImage" name="userImage"/>

				</label>
				<br>
				<label for="firstname">Voornaam</label>
				<input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}">
				<br>
				<label for="insertion">Tussenvoegsel</label>
				<input type="text" name="insertion" class="form-control" value="{{ $user->insertion }}">
				<br>
				<label for="lastname">Achternaam</label>
				<input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}">
				<br>
				<label for="email">Email adres</label>
				<input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
				<br>
				<button type="submit" class="btn btn-primary">Verander gegevens</button>
		</form>
		</div>
	</div>
@endsection