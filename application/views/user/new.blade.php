@layout('layouts.default')

@section('content')

	<div class="container">

		<div class="row-fluid">

			<h2>Registreren</h2>

			{{ Form::open('register') }}

				{{ Form::token() }}

				<div class="control-group {{ ($errors->first('voornaam') ? 'error' : '') }}">
					{{ Form::label('voornaam', 'Voornaam', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('voornaam', Input::old('voornaam')) }}
						{{ $errors->first('voornaam', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('achternaam') ? 'error' : '') }}">
					{{ Form::label('achternaam', 'Achternaam', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('achternaam', Input::old('achternaam')) }}
						{{ $errors->first('achternaam', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('email') ? 'error' : '') }}">
					{{ Form::label('email', 'E-mail adres', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('email', Input::old('email')) }}
						{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('password') ? 'error' : '') }}">
					{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::password('password') }}
						{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('password_confirmation') ? 'error' : '') }}">
					{{ Form::label('password_confirmation', 'Password (Confirm)', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::password('password_confirmation') }}
						{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('adres') ? 'error' : '') }}">
					{{ Form::label('adres', 'Adres', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('adres', Input::old('adres')) }}
						{{ $errors->first('adres', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('postcode') ? 'error' : '') }}">
					{{ Form::label('postcode', 'Postcode', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('postcode', Input::old('postcode')) }}
						{{ $errors->first('postcode', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('woonplaats') ? 'error' : '') }}">
					{{ Form::label('woonplaats', 'Woonplaats', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('woonplaats', Input::old('woonplaats')) }}
						{{ $errors->first('woonplaats', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('land') ? 'error' : '') }}">
					{{ Form::label('land', 'Land', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('land', Input::old('land')) }}
						{{ $errors->first('land', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				{{ Form::submit('Sign Me Up!', array('class' => 'btn btn-large btn-primary')) }}

			{{ Form::close() }}

		</div>

	</div>

@endsection