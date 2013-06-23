@layout('layouts.default')

@section('content')

<div class="pageTitle">
	<div class="container">
		<h1>Wordt lid! <small>met een aantal kleine stappen</small></h1>
	</div>
</div>

<div class="content">

	<div class="container">

		<div class="row-fluid">

			{{ Form::open('register', 'POST', array('class' => 'form-horizontal')) }}

				{{ Form::token() }}
				<div class="container">

					<div class="row-fluid">

						<div class="span6">

							<h3>Account informatie</h3>

							<div class="control-group {{ ($errors->first('email') ? 'error' : '') }}">
								{{ Form::label('email', 'E-mailadres', array('class' => 'control-label')) }}
								<div class="controls">
									{{ Form::text('email', Input::old('email')) }}
									{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
								</div>
							</div>

							<div class="control-group {{ ($errors->first('password') ? 'error' : '') }}">
								{{ Form::label('password', 'Wachtwoord', array('class' => 'control-label')) }}
								<div class="controls">
									{{ Form::password('password') }}
									{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
								</div>
							</div>

							<div class="control-group {{ ($errors->first('password_confirmation') ? 'error' : '') }}">
								{{ Form::label('password_confirmation', 'Herhaal wachtwoord', array('class' => 'control-label')) }}
								<div class="controls">
									{{ Form::password('password_confirmation') }}
									{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}
								</div>
							</div>

						</div><!--/span6-->

						<div class="span6">

							<h3>Persoonlijke informatie</h3>

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

							<div class="control-group {{ ($errors->first('prefix') ? 'error' : '') }}">
								{{ Form::label('prefix', 'Tussenvoegsel', array('class' => 'control-label')) }}
								<div class="controls">
									{{ Form::text('prefix', Input::old('prefix')) }}
									{{ $errors->first('prefix', '<span class="help-inline">:message</span>') }}
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

							<div class="control-group">
								<div class="controls">
									{{ Form::submit('Registreren', array('class' => 'btn btn-primary')) }}
								</div>
							</div>

						</div><!--/span6-->

					</div><!--/row-fluid-->

				</div><!--container-->

			{{ Form::close() }}

		</div>

	</div>

</div>

@endsection