@extends('layouts.app')
@section('nav')
	@include('restrictions.level')
@endsection
@section('content')
	<div class="container" style="margin-top: 100px;">
		
				<div class="col-md-6 col-md-offset-3">
			<h3>Verander gegevens</h3>
			<br>
			<form action="{{ url('/employee/update/') }}" method="post" class="form-horizontal">
				{{ csrf_field() }}
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
				<label for="jobtitle">Vakgebied</label>
				<select name="jobTitle" id="jobtitle" class="form-control">
					@if(!$user->jobTitle)
						<option value="0">Selecteer een vakgebied...</option>	
					@endif
				
					@foreach($collection as $job)
						<option value="{{ $job->id }}"
							@if($job->name == $user->jobTitle)
								selected
							@endif
						>{{ $job->name }}</option>	
					@endforeach
				</select>
				<br>
				<button type="submit" class="btn btn-primary">Verander gegevens</button>
		</form>
		</div>
	</div>
@endsection