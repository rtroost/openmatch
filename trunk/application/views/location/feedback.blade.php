@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span6">

				@if(Auth::check())

				<h3>Meld hier uw feedback over de locatie!</h3>

				{{ Form::open(URL::to_route('location_feedback_post'), 'POST', array('class' => 'form-vertical')) }}

				{{ Form::token() }}

				<div class="control-group">
					{{ Form::label('location-title', 'De naam van de locatie', array('class' => 'control-label')) }}
					<div class="controls">
						<input class="span12" id="location-title" type="text" name="location-title" value="{{$location->name}}" disabled>
					</div>
					{{ $errors->first('location-title', '<span class="help-inline">:message</span>') }}
				</div>

				<div class="control-group">
					{{ Form::label('location-message', 'Uw bericht', array('class' => 'control-label')) }}
					<div class="controls">
						<textarea class="span12" id="location-message" name="location-message"></textarea>
					</div>
					{{ $errors->first('location-message', '<span class="help-inline">:message</span>') }}
				</div>

				<input id="location-id" name="location-id" value="{{$location->id}}" hidden>
				<div class="control-group">
					<div class="controls">
						{{ Form::submit('Feedback melden', array('class' => 'btn btn-primary')) }}
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
					Alle locaties op deze website zijn afkomstig van Rotterdam Open Data. Het kan voorkomen dat bepaalde gegevens van een locatie niet kloppen of niet meer actueel zijn. Via het formulier op deze pagina kunt aangeven of er iets niet klopt van de locatie. Bijvoorbeeld de website, het telefoonnummer, of het adres. De medewerkers van Rotterdam Onbeperkt zullen uw feedback controleren en zo snel mogelijk doorvoeren.
				</p>
			</div><!--/span6-->

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection