@layout('layouts.default')

@section('content')

	<div class="container">

		<div class="row-fluid">

			<h2>Registreren</h2>

			{{ Form::open('register') }}

				{{ Form::token() }}

				<div class="control-group {{ ($errors->first('name') ? 'error' : '') }}">
					{{ Form::label('name', 'Voornaam', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('name', Input::old('name')) }}
						{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('surname') ? 'error' : '') }}">
					{{ Form::label('surname', 'Achternaam', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('surname', Input::old('surname')) }}
						{{ $errors->first('surname', '<span class="help-inline">:message</span>') }}
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

				<div class="control-group {{ ($errors->first('address') ? 'error' : '') }}">
					{{ Form::label('address', 'Adres', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('address', Input::old('address')) }}
						{{ $errors->first('address', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('zipcode') ? 'error' : '') }}">
					{{ Form::label('zipcode', 'Postcode', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('zipcode', Input::old('zipcode')) }}
						{{ $errors->first('zipcode', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('city') ? 'error' : '') }}">
					{{ Form::label('city', 'Woonplaats', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('city', Input::old('city')) }}
						{{ $errors->first('city', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('country') ? 'error' : '') }}">
					{{ Form::label('country', 'Land', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('country', Input::old('country')) }}
						{{ $errors->first('country', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				{{ Form::submit('Sign Me Up!', array('class' => 'btn btn-large btn-primary')) }}

			{{ Form::close() }}

		</div>

	</div>

@endsection