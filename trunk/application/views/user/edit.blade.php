@layout('layouts.default')

@section('content')

	<div class="container">

		<div class="row-fluid">
			<h2>Your profile</h2>

			{{ Form::open('user', 'PUT') }}

				{{ Form::token() }}

				{{ Form::hidden('id', $userdata -> id) }}

				<p> Your email address: {{ $userdata -> email }} </p>
				
				<div class="control-group {{ ($errors->first('voornaam') ? 'error' : '') }}">
					{{ Form::label('voornaam', 'Voornaam', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('voornaam', Input::old('voornaam', $userdata->voornaam)) }}
						{{ $errors->first('voornaam', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('achternaam') ? 'error' : '') }}">
					{{ Form::label('achternaam', 'Achternaam', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('achternaam', Input::old('achternaam', $userdata->achternaam)) }}
						{{ $errors->first('achternaam', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('adres') ? 'error' : '') }}">
					{{ Form::label('adres', 'Adres', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('adres', Input::old('adres', $userdata->adres)) }}
						{{ $errors->first('adres', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('postcode') ? 'error' : '') }}">
					{{ Form::label('postcode', 'Postcode', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('postcode', Input::old('postcode', $userdata->postcode)) }}
						{{ $errors->first('postcode', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('woonplaats') ? 'error' : '') }}">
					{{ Form::label('woonplaats', 'Woonplaats', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('woonplaats', Input::old('woonplaats', $userdata->woonplaats)) }}
						{{ $errors->first('woonplaats', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('land') ? 'error' : '') }}">
					{{ Form::label('land', 'Land', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('land', Input::old('land', $userdata->land)) }}
						{{ $errors->first('land', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				{{ Form::submit('Save my profile', array('class' => 'btn btn-large btn-primary')) }}

			{{ Form::close() }}
		</div>

	</div>

@endsection