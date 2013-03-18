@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Registreren</h2>

	{{ Form::open('users') }}

		{{ Form::label('voornaam', 'Voornaam') }}
		{{ Form::text('voornaam', Input::old('voornaam')) }}
		{{ $errors->first('voornaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('achternaam', 'Achternaam') }}
		{{ Form::text('achternaam', Input::old('achternaam')) }}
		{{ $errors->first('achternaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('email', 'E-Mail Address') }}
		{{ Form::text('email', Input::old('email')) }}
		{{ $errors->first('email', '<p>:message</p>') }}
		<br />

		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		{{ $errors->first('password', '<p>:message</p>') }}
		<br />

		{{ Form::label('password_confirmation', 'Password controller') }}
		{{ Form::password('password_confirmation') }}
		{{ $errors->first('password_confirmation', '<p>:message</p>') }}
		<br />

		{{ Form::label('adres', 'Adres') }}
		{{ Form::text('adres', Input::old('adres')) }}
		{{ $errors->first('adres', '<p>:message</p>') }}
		<br />

		{{ Form::label('postcode', 'Postcode') }}
		{{ Form::text('postcode', Input::old('postcode')) }}
		{{ $errors->first('postcode', '<p>:message</p>') }}
		<br />

		{{ Form::label('woonplaats', 'Woonplaats') }}
		{{ Form::text('woonplaats', Input::old('woonplaats')) }}
		{{ $errors->first('woonplaats', '<p>:message</p>') }}
		<br />

		{{ Form::label('land', 'Land') }}
		{{ Form::text('land', Input::old('land')) }}
		{{ $errors->first('land', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection