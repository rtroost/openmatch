@layout('layouts.default')

@section('content')

<div class="pageTitle">
	<div class="container">
		<h1>Profiel aanpassen</h1>
	</div>
</div>

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span6">

				<h3>Persoonlijke informatie</h3>

				{{ Form::open(URL::to_route('user_profile_updateData'), 'PUT', array('class' => 'form-horizontal')) }}

					{{ Form::token() }}

					<div class="control-group">
						{{ Form::label('email', 'E-Mail', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('email', Input::old('email', $userdata -> email), array('disabled' => 'disabled')) }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('name') ? 'error' : '') }}">
						{{ Form::label('name', 'Voornaam', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('name', Input::old('name', $userdata->name)) }}
							{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('surname') ? 'error' : '') }}">
						{{ Form::label('surname', 'Achternaam', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('surname', Input::old('surname', $userdata->surname)) }}
							{{ $errors->first('surname', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('address') ? 'error' : '') }}">
						{{ Form::label('address', 'Adres', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('address', Input::old('address', $userdata->address)) }}
							{{ $errors->first('address', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('zipcode') ? 'error' : '') }}">
						{{ Form::label('zipcode', 'Postcode', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('zipcode', Input::old('zipcode', $userdata->zipcode)) }}
							{{ $errors->first('zipcode', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('city') ? 'error' : '') }}">
						{{ Form::label('city', 'Woonplaats', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('city', Input::old('city', $userdata->city)) }}
							{{ $errors->first('city', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('country') ? 'error' : '') }}">
						{{ Form::label('country', 'Land', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('country', Input::old('country', $userdata->country)) }}
							{{ $errors->first('country', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							{{ Form::submit('Gegevens opslaan', array('class' => 'btn btn-primary')) }}
						</div>
					</div>

				{{ Form::close() }}
			</div>
			<div class="span6">
				<h3>Wachtwoord aanpassen</h3>

				{{ Form::open(URL::to_route('user_profile_updatePassword'), 'PUT', array('class' => 'form-horizontal')) }}

					{{ Form::token() }}

					<div class="control-group">
						{{ Form::label('old_password', 'Oud wachtwoord', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::password('old_password') }}
						</div>
					</div>

					<div class="control-group">
						{{ Form::label('password', 'Nieuw wachtwoord', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::password('password') }}
						</div>
					</div>

					<div class="control-group">
						{{ Form::label('password_confirmation', 'Nieuw wachtwoord (Opnieuw)', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::password('password_confirmation') }}
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							{{ Form::submit('Verander wachtwoord', array('class' => 'btn btn-primary')) }}
						</div>
					</div>

				{{ Form::close() }}
			</div>
		</div>

	</div>

</div>

@endsection