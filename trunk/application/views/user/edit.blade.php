@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Registreren</h2>

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	{{ Form::open('users', 'PUT') }}

		{{ Form::hidden('id', $userdata->user_id) }}

		<p> Your email address: {{ $userdata->email }} </p>

		<p>
			{{ Form::label('voornaam', 'Voornaam') }}
			{{ Form::text('voornaam', Input::old('voornaam', $userdata->voornaam)) }}
			{{ $errors->first('voornaam', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('achternaam', 'Achternaam') }}
			{{ Form::text('achternaam', Input::old('achternaam', $userdata->achternaam)) }}
			{{ $errors->first('achternaam', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('adres', 'Adres') }}
			{{ Form::text('adres', Input::old('adres', $userdata->adres)) }}
			{{ $errors->first('adres', '<p>:message</p>') }}
		</p>
		
		<p>
			{{ Form::label('postcode', 'Postcode') }}
			{{ Form::text('postcode', Input::old('postcode', $userdata->postcode)) }}
			{{ $errors->first('postcode', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('woonplaats', 'Woonplaats') }}
			{{ Form::text('woonplaats', Input::old('woonplaats', $userdata->woonplaats)) }}
			{{ $errors->first('woonplaats', '<p>:message</p>') }}
		</p>

		<p>
			{{ Form::label('land', 'Land') }}
			{{ Form::text('land', Input::old('land', $userdata->land)) }}
			{{ $errors->first('land', '<p>:message</p>') }}
		</p>

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection