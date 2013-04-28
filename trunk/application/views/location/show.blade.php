@layout('layouts.default')

@section('content')

<!-- <div class="pageTitle">
	<div class="container">
		<h1>Hier kan een titel <small>om te pagina te verduidelijken</small></h1>
	</div>
</div> -->

<div class="content">

	<div class="container">

		<div class="location">

			<div class="row-fluid">

				<div class="span4">
					<div class="location-map">
						<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:100%; height:100%;" src="https://maps.google.nl/maps?q={{$location->latitude}}+,{{$location->longitude}}&amp;output=embed"></iframe>
					</div>
				</div><!--/span5-->

				<div class="span8">

					<ul class="nav nav-tabs">
					  <li class="active"><a href="#general" data-toggle="tab">Informatie</a></li>
					  <li><a href="#route" data-toggle="tab">Routebeschrijving</a></li>
					  <li><a href="#taxi" data-toggle="tab">Taxi bestellen</a></li>
					</ul>

					<div class="tab-content">
					  <div class="tab-pane active" id="general">
					  	<h3>{{ $location->name }}</h3>
							<table>
								@if( $location->website )
								<tr>
									<td>Website:</td>
									<td><a href="{{ $location->website }}">{{ $location->website }}</a></td>
								</tr>
								@endif
								<tr>
									<td>Adres:</td>
									<td>{{ $location->street }} {{ $location->number }}</td>
								</tr>
								<tr>
									<td>Postcode:</td>
									<td>{{ $location->postalcode }}</td>
								</tr>
								<tr>
									<td>Plaats:</td>
									<td>{{ $location->city }}</td>
								</tr>
								<tr>
									<td>Types:</td>
									<td>
										@foreach($location->types as $type)
											{{ $type->naam }}
										@endforeach
									</td>
								</tr>
							</table>

							<hr />

							<h5>Bent je al op deze locatie geweest? Geef je beoordeling!</h5>

							@if( ! Auth::check())
								<p>
									Je moet je eerst {{ HTML::link_to_route('login', 'aanmelden') }} of {{ HTML::link_to_route('register', 'registreren') }} om een beoordeling te kunnen geven.
								</p>
							@else
								@if($thumbState !== null)
									@if($thumbState -> positive)
										<a href="{{ URL::to_route('location_thumbAction', array($location -> id, 'up')) }}" class="btn thumbRating activePos"><i class="icon-thumbs-up"></i> Positief</a>
										<a href="{{ URL::to_route('location_thumbAction', array($location -> id, 'down')) }}" class="btn thumbRating small"><i class="icon-thumbs-down"></i> Negatief</a>
									@else
										<a href="{{ URL::to_route('location_thumbAction', array($location -> id, 'up')) }}" class="btn thumbRating small"><i class="icon-thumbs-up"></i> Positief</a>
										<a href="{{ URL::to_route('location_thumbAction', array($location -> id, 'down')) }}" class="btn thumbRating activeNeg"><i class="icon-thumbs-down"></i> Negatief</a>
									@endif
								@else
									<a href="{{ URL::to_route('location_thumbAction', array($location -> id, 'up')) }}" class="btn thumbRating"><i class="icon-thumbs-up"></i> Positief</a>
									<a href="{{ URL::to_route('location_thumbAction', array($location -> id, 'down')) }}" class="btn thumbRating"><i class="icon-thumbs-down"></i> Negatief</a>
								@endif
							@endif
					  </div>
					  <div class="tab-pane" id="route">
					  	<div id="directions-container">

								{{ Form::open('tba', 'POST', array('class' => 'form-vertical')) }}

								{{ Form::token() }}

								<div class="control-group">
									{{ Form::label('origin', 'Bepaal waar vandaan je wilt vertrekken', array('class' => 'control-label')) }}
									<div class="controls">
										<div class="input-append" style="width:80%">
											<input class="span12" id="origin-input" type="text" name="origin">
											<span class="add-on" id="get-geolocation"><i class="icon-screenshot"></i></span>
										</div>
									</div>
								</div>

								<div class="control-group">
									{{ Form::label('transport', 'Op welke manier wil je er komen?', array('class' => 'control-label')) }}
									<div class="controls">
										<select name="transport" id="transport-input">
											<option value="driving">Auto</option>
											<option value="transit">Openbaar vervoer</option>
											<option value="walking">Lopend</option>
											<option value="bicycling">Fietsend</option>
										</select>
									</div>
								</div>

								<div class="control-group">
									<div class="controls">
										{{ Form::submit('Zoeken', array('class' => 'btn btn-primary', 'id' => 'btn_getDirections')) }}
									</div>
								</div>

								{{ Form::close() }}

							</div>

							<div id="directions-result">
								<h3>Routebeschrijving</h3>
								<ul class="unstyled"></ul>
								<a href="#" target="_blank" id="directions-gotoGMaps">Klik hier om naar Google Maps te gaan voor een uitgebreidere versie</a>
							</div>

					  </div>
					  <div class="tab-pane" id="taxi">

					  </div>
					</div>

				</div><!--/span8-->

			</div><!--/row-fluid-->

			<div class="row-fluid">

				<hr />

				<h3>Opmerkingen en beoordelingen</h3>

				<div id="comment-container">

					@forelse($location -> comments as $comment)

					<div class="comment">

						<div class="comment-inner">

							<div class="comment-inner-author">
								<a href="#">{{ ucwords($comment -> user -> name) . ' ' . ucwords($comment -> user -> surname) }}</a> <small>zei op {{ date('j F Y \o\m G:i', strtotime($comment -> created_at)) }}:</small>
							</div><!--/comment-inner-author-->

							<div class="comment-inner-body">
								{{ $comment -> body }}
							</div><!--/comment-inner-body-->

						</div><!--/comment-inner-->

					</div><!--/comment-->

					@empty
						<p>Er zijn geen beoordelingen te tonen.</p>
					@endforelse

				</div><!--/comment-container-->

				<div id="comment_post">

					<h3>Geef je oordeel of discusseer mee!</h3>

					@if( ! Auth::check())

					<div class="comment_post-notLoggedIn">
						Je moet eerst {{ HTML::link_to_route('login', 'aanmelden') }} of {{ HTML::link_to_route('register', 'registreren') }} om hier gebruik van te maken.
					</div>

					@else

					{{ Form::open(URL::to_route('location_post_comment', $location -> id), 'POST', array('class' => 'form-verticle')) }}

					{{ Form::token() }}

					{{ Form::hidden('location_id', $location -> id) }}

					<div class="control-group {{ ($errors->first('message_body') ? 'error' : '') }}">
						{{ Form::label('message_body', 'Uw bericht', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::textarea('message_body', Input::old('message_body'), array('class' => 'input-xxlarge')) }}
							{{ $errors->first('message_body', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							{{ Form::submit('Verstuur', array('class' => 'btn btn-large')) }}
						</div>
					</div>

					{{ Form::close() }}

					@endif

				</div>

			</div><!--/row-fluid-->

		</div><!--/location-->
	</div><!--/container-->
</div><!--/content-->

@include('handlebar-templates/locationrow')

@endsection

@section('extra_scripts')
<script>
$(document).ready(function() {
	$('#btn_getDirections').on('click', function(e) {

		e.preventDefault(); // Prevent form from submitting

		var location_origin = encodeURIComponent($('#origin-input').val());
		var location_destination = encodeURIComponent('{{ $location -> postalcode . '+' . $location -> number . ',+' . $location -> city }}');
		var transport_mode = $('#transport-input').val();

		$.ajax({
			url: 'http://maps.googleapis.com/maps/api/directions/json?origin=' + location_origin + '&destination=' + location_destination + '&sensor=false' + '&mode=' + transport_mode,
			// data: {'action': 'geo'},
			dataType: 'json'
		}).promise().then(
			function( results ){ //success

				console.log(results);

				var steps = results['routes'][0]['legs'][0]['steps'];
				var directionsHTML = [];

				for (var i = 0; i < steps.length; i++) {
					step = steps[i];
					directionsHTML.push('<li><i class="icon-caret-right"></i> ' + step['html_instructions'] + '</li>');
				}

				$("#directions-result ul").html(directionsHTML);
				$("#directions-result").slideDown(600);

				$("#directions-gotoGMaps").attr('href').val('');
			},
			function(){ //failed
				console.log("Something went wrong during the ajax request.");
				maps_locations.deferred.reject();
			}
		);

	});
});
</script>
@endsection