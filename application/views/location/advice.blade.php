@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span6">

				@if(Auth::check())

				<h3>Geef hier een nieuwe locatie op!</h3>

				{{ Form::open(URL::to_route('location_advice_post'), 'POST', array('class' => 'form-vertical')) }}

				{{ Form::token() }}

				<div class="control-group">
					{{ Form::label('location-title', 'Wat is de naam van de locatie?', array('class' => 'control-label')) }}
					<div class="controls">
						<input class="span12" id="location-title" type="text" name="location-title" value="{{ Input::old('location-title') }}">
					</div>
					{{ $errors->first('location-title', '<span class="help-inline">:message</span>') }}
				</div>

				<div class="control-group">
					{{ Form::label('location-website', 'Wat is de website van de locatie?', array('class' => 'control-label')) }}
					<div class="controls">
						<input class="span12" id="location-website" type="text" name="location-website" placeholder="http://www.adres.nl/" value="{{ Input::old('location-website') }}">
					</div>
					{{ $errors->first('location-website', '<span class="help-inline">:message</span>') }}
				</div>

				<div class="control-group">
					{{ Form::label('location-address', 'Wat is het adres van de locatie?', array('class' => 'control-label')) }}
					<div class="controls">
						<input class="span12" id="location-address" type="text" name="location-address" placeholder="Adresstraat 999, 9999 AA Rotterdam" value="{{ Input::old('location-address') }}">
					</div>
					{{ $errors->first('location-address', '<span class="help-inline">:message</span>') }}
				</div>

				<div class="control-group">
					{{ Form::label('location-category', 'In welke categorie past de locatie?', array('class' => 'control-label')) }}
					<div class="controls">
						<input class="span12" id="location-category" type="text" name="location-category" placeholder="i.e.: Restaurants, Bioscopen, etc." value="{{ Input::old('location-category') }}">
					</div>
					{{ $errors->first('location-category', '<span class="help-inline">:message</span>') }}
				</div>

				<div class="control-group">
					<div class="controls">
						{{ Form::submit('Opgeven', array('class' => 'btn')) }}
					</div>
				</div>

				{{ Form::close() }}

				@else

				<h3>Aanmelden</h3>
				<p>
					Om deze functionaliteit te kunnen gebruiken dient u zich eerst <a href="{{URL::to_route('login')}}">aan te melden</a> of te <a href="{{URL::to_route('register')}}">registreren</a>. Registreren bij Rotterdam Onbeperkt duurt slechts enkele seconden!
				</p>

				@endif

			</div><!--/span6-->

			<div class="span6">

				<h3>Informatie</h3>
				<p>
					Wij stellen het zeer op prijs dat u een nieuwe locatie wilt toevoegen aan Rotterdam Onbeperkt. Nadat u de locatie heeft opgegeven zullen de medewerkers van Rotterdam Onbeperkt uw aanmelding beoordelen. Indien uw opgegeven locatie correct is zal deze binnen enkele dagen op de website te vinden zijn.
				</p>
			</div><!--/span6-->

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection