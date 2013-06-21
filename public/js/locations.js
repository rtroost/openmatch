$(document).ready(function() {

	$('.rating-div').raty({
		score: function() {
			return $(this).attr('data-score');
		},
		scoreName: function() {
			return 'scores[' + $(this).attr('data-category') + ']';
		},
		path: BASE + 'img',
		hints: ['Zeer slecht', 'Slecht', 'Acceptabel', 'Goed', 'Zeer goed']
	});
	
	$('.rating-read-only').raty({
		score: function() {
			return $(this).attr('data-score');
		},
		readOnly: true,
		half: true,
		path: BASE + 'img',
		hints: ['Zeer slecht', 'Slecht', 'Acceptabel', 'Goed', 'Zeer goed']
	});

	var span_formatted_address = $('span.location_formatted_address');
	var span_postalcode = $('span.location_postalcode');
	var span_number = $('span.location_number');
	var span_city = $('span.location_city');

	var locationinput = $('input#origin-input'),
		controlGroupTarget = $('div#controlGroupTarget'),
		locationError = $('span#locationError');

	locationinput.keypress(function(e) {
	    if(e.which == 13) {
	    	e.preventDefault();
	        getGeolocation()
	    }
	});

	$('span#get-geolocation').on('click', getGeolocation);

	function getGeolocation(){
		var successCallback = function( results ) {
			if(results.status === 'OK'){
				controlGroupTarget.removeClass("error");
				locationError.hide();

				locationinput.val(results.results[0].formatted_address);

				console.log("Lat = " + results.results[0].geometry.location.lat);
				console.log("Lng = " + results.results[0].geometry.location.lng);
			} else if(results.status === 'ZERO_RESULTS') {
				controlGroupTarget.addClass("error");
				locationError.show();
			}
		}

		var failedCallback = function () { console.log("Something went wrong during the ajax request."); }

		getLocationGoogleMaps(locationinput.val(), successCallback, failedCallback);
	}

	$('#btn_getDirections').on('click', function(e) {

		e.preventDefault(); // Prevent form from submitting

		var location_origin = $('#origin-input').val();
		if(span_formatted_address.text() == "") {
			var location_destination = span_postalcode.text() + ' ' +  span_number.text() + ' ' + span_city.text();
		} else {
		    var location_destination = span_formatted_address.text();
		}

		var transport_mode = $('#transport-input').val();

		var url = 'http://maps.googleapis.com/maps/api/directions/json?origin=' + encodeURIComponent(location_origin) + '&destination=' + encodeURIComponent(location_destination) + '&sensor=false' + '&mode=' + transport_mode;

		if(transport_mode == "transit") {
			url =  url + "&departure_time=" + (Math.round(new Date().getTime() / 1000));
		}

		console.log('location_origin: ' + location_origin);
		console.log('location_destination: ' + location_destination);
		console.log('transport_mode: ' + transport_mode);
		console.log('url: ' + url);

		$.ajax({
			url: url,
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

				$("#directions-gotoGMaps").attr('href', 'https://maps.google.com/maps?saddr=' + location_origin + '&daddr=' + location_destination + '&mode=' + transport_mode);
			},
			function(){ //failed
				console.log("Something went wrong during the ajax request.");
				maps_locations.deferred.reject();
			}
		);

	});
});