@layout('layouts.default')

@section('content')

	<div class="container">

		<div class="row-fluid">

			<h2>Registreren</h2>

			{{ Form::open('users') }}

				{{ Form::token() }}

				<p>
					{{ Form::label('voornaam', 'Voornaam') }}
					{{ Form::text('voornaam', Input::old('voornaam')) }}
					{{ $errors->first('voornaam', '<p>:message</p>') }}
				</p>

				<p>
					{{ Form::label('achternaam', 'Achternaam') }}
					{{ Form::text('achternaam', Input::old('achternaam')) }}
					{{ $errors->first('achternaam', '<p>:message</p>') }}
				</p>

				<p>
					{{ Form::label('email', 'E-Mail Address') }}
					{{ Form::text('email', Input::old('email')) }}
					{{ $errors->first('email', '<p>:message</p>') }}
				</p>

				<p>
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password') }}
					{{ $errors->first('password', '<p>:message</p>') }}
				</p>

				<p>
					{{ Form::label('password_confirmation', 'Password (Confirm)') }}
					{{ Form::password('password_confirmation') }}
					{{ $errors->first('password_confirmation', '<p>:message</p>') }}
				</p>

				<p>
					{{ Form::label('adres', 'Adres') }}
					{{ Form::text('adres', Input::old('adres')) }}
					{{ $errors->first('adres', '<p>:message</p>') }}
				</p>

				<p>
					{{ Form::label('postcode', 'Postcode') }}
					{{ Form::text('postcode', Input::old('postcode')) }}
					{{ $errors->first('postcode', '<p>:message</p>') }}
				</p>

				<p>
					{{ Form::label('woonplaats', 'Woonplaats') }}
					{{ Form::text('woonplaats', Input::old('woonplaats')) }}
					{{ $errors->first('woonplaats', '<p>:message</p>') }}
				</p>

				<p>
					{{ Form::label('land', 'Land') }}
					{{ Form::text('land', Input::old('land')) }}
					{{ $errors->first('land', '<p>:message</p>') }}
				</p>

				{{ Form::submit('Sign Me Up!') }}

			{{ Form::close() }}

		</div>

	</div>

@endsection