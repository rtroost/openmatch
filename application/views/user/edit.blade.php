@layout('layouts.default')

@section('content')

	<div class="container">

		<div class="row-fluid">
			<h2>Your profile</h2>

			{{ Form::open('user', 'PUT') }}

				{{ Form::token() }}

				{{ Form::hidden('id', $userdata -> id) }}

				<p> Your email address: {{ $userdata -> email }} </p>
				
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

				{{ Form::submit('Save my profile', array('class' => 'btn btn-large btn-primary')) }}

			{{ Form::close() }}
		</div>

	</div>

@endsection