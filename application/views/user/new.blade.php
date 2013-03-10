@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Registreren</h2>

	{{ Form::open('users') }}

		{{ Form::label('voornaam', 'Voornaam') }}
		{{ Form::text('voornaam', Session::get('form_values.voornaam')) }}
		{{ $errors->first('voornaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('achternaam', 'Achternaam') }}
		{{ Form::text('achternaam', Session::get('form_values.achternaam')) }}
		{{ $errors->first('achternaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('email', 'E-Mail Address') }}
		{{ Form::text('email', Session::get('form_values.email')) }}
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
		{{ Form::text('adres', Session::get('form_values.adres')) }}
		{{ $errors->first('adres', '<p>:message</p>') }}
		<br />

		{{ Form::label('postcode', 'Postcode') }}
		{{ Form::text('postcode', Session::get('form_values.postcode')) }}
		{{ $errors->first('postcode', '<p>:message</p>') }}
		<br />

		{{ Form::label('city', 'Stad') }}
		{{ Form::text('city', Session::get('form_values.city')) }}
		{{ $errors->first('city', '<p>:message</p>') }}
		<br />

		{{ Form::label('land', 'Land') }}
		{{ Form::text('land', Session::get('form_values.land')) }}
		{{ $errors->first('land', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection