@layout('layouts.default')

@section('content')

<div class="pageTitle">
	<div class="container">
		<h1>Hier kan een titel <small>om te pagina te verduidelijken</small></h1>
	</div>
</div>

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span8">
				<div id="location_list" class="clearfix">
					<ul id="locationWrapper">
						<!-- <li class="clearfix">
							<a href="#">
								<div class="event-list-body">
									<span class="event-list-body-title">
										De dronken geit
									</span>
									<span class="event-list-body-description">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
									</span>
									<span class="event-list-body-metadata">
										Type: Restaurant - Tags: Rolstoelers
									</span>
								</div>
							</a>
						</li> -->
					</ul>
				</div><!--/event_list-->
			</div><!--/span9-->

			<div class="span4">
				<div class="sidebar">
					<div class="sidebar_block">
						<p>Ken je een locatie die je graag in deze lijst terug zou willen zien? Laat het ons weten!</p>
						<a href="{{ URL::to_route('location_advice') }}" class="btn btn-small">Geef advies</a>
					</div>
					<div id="locationFilterBlock" class="sidebar_block">
						<h4>Filter op locatie</h4>

						<div id="locationInputControl" class="control-group">
							<div class="controls">
								<div class="input-append" style="width:90%">
									<input class="span12" id="filter_location-input" type="text" name="filter_location-input" placeholder="Wat is uw startadres?">
									<span class="add-on" id="filter_location-get-geolocation"><i class="icon-screenshot"></i></span>
								</div>
								<span class="help-block">Please correct the error</span>
							</div>
						</div>

						<div class="control-group">
							{{ Form::label('filter_location-range', 'Maximale afstand', array('class' => 'control-label')) }}
							<div class="controls">
								<input id="filter_location-range" name="filter_location-range" class="span9" type="range" min="1" max="100" value="1" /><span id="filter_location-range-value">1 km</span>
							</div>
						</div>

					</div>
					<div class="sidebar_block">
						<h4>Filters</h4>
						<hr class="hr-small" />
						<h5>Type uitgaansgelegenheden</h5>
						<ul class="unstyled" id="locationfilter" >
							<li>
								<label class="checkbox">
										{{ Form::checkbox('bibliotheken', 'bibliotheken') }} Bibliotheken
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('bioscopen', 'bioscopen') }} Bioscopen
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('campings', 'campings') }} Campings
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('sportgelegenheden', 'sportgelegenheden') }} Sportgelegenheden
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('kinderboerderijen', 'kinderboerderijen') }} Kinderboerderijen
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('kindervermaak', 'kindervermaak') }} Kindervermaak
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('theaters', 'theaters') }} Theaters
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('recreatieterreinen', 'recreatieterreinen') }} Recreatieterreinen
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('zwembaden', 'zwembaden') }} Zwembaden
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('musea', 'musea') }} Musea
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('restaurants', 'restaurants') }} Restaurants
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('dierentuin', 'dierentuin') }} Dierentuin
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('attracties', 'attracties') }} Attracties
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('speeltuinen', 'speeltuinen') }} Speeltuinen
								</label>
							</li>
						</ul>
					</div><!--/sidebar_block-->
				</div><!--/sidebar-->
			</div><!--/span3-->

		</div><!--/row-fluid-->
	</div><!--/container-->
</div><!--/content-->

@include('handlebar-templates/locationrow')

@endsection

@section('extra_scripts')
<script>
$(document).ready(function() {

	window.curPlaceLat = undefined;
	window.curPlaceLng = undefined;
	var locationFilterBlock = $('div#locationFilterBlock');
	var locationInputControl = locationFilterBlock.find('div#locationInputControl');
	var locationInput = locationFilterBlock.find('input#filter_location-input');
	var spanError = locationFilterBlock.find('span.help-block').hide();

	$("#filter_location-range").change( function() {
		$("#filter_location-range-value").html($(this).val() + ' km');
	});

	$('#filter_location-get-geolocation').on('click', function() {
		console.log(locationInput);
		if(locationInput.val() !== ""){
			console.log(locationInput.val());

			$.ajax({
				type: "POST",
				url: 'http://maps.googleapis.com/maps/api/geocode/json?address=' + encodeURIComponent(locationInput.val()) + '&sensor=false',
				dataType: 'json'
			}).promise().then(
				function( results ){ //success
					console.log(results);
					if(results.status === 'OK'){
						locationInputControl.removeClass("error");
						spanError.hide();

						locationInput.val(results.results[0].formatted_address);
						curPlaceLat = results.results[0].geometry.location.lat;
						curPlaceLng = results.results[0].geometry.location.lng;
						console.log("Lat = " + results.results[0].geometry.location.lat);
						console.log("Lng = " + results.results[0].geometry.location.lng);
					} else if(results.status === 'ZERO_RESULTS') {
						console.log(locationInputControl);
						locationInputControl.addClass("error");
						spanError.show();
					}
					
					// console.log(results.results[0].formatted_address);
					// console.log(results.results[0].geometry.location.lat);
					// console.log(results.results[0].geometry.location.lng);
				},
				function(){ //failed
					console.log("Something went wrong during the ajax request.");
				}
			);
		} else {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {

					var geocoder = new google.maps.Geocoder();
					var latLng = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
					//console.log(latLng);
					curPlaceLat = latLng.lat();
					curPlaceLng = latLng.lng();
					console.log("Lat = " + latLng.lat());
					console.log("Lng = " + latLng.lng());

					if (geocoder) {
						geocoder.geocode({'latLng': latLng}, function (results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								$('#filter_location-input').val(results[0].formatted_address);
							} else {
								console.log("Geocoding failed: " + status);
							}
						});
					}

				});
			} else {
				alert('Geolocation is not supported by this browser.');
			}
		}
	});


});
</script>
@endsection