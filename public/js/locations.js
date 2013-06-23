$(document).ready(function() {

	var htmlbody = $('html, body');

	var ulTabs = $('ul#tab');
	var mapBig = $('div#mapBig');
	var locationMarker = $('img#location-marker-img');

	var span_formatted_address = $('span.location_formatted_address');
	var span_postalcode = $('span.location_postalcode');
	var span_number = $('span.location_number');
	var span_city = $('span.location_city');

	var curPlaceLat = undefined;
	var curPlaceLng = undefined;

	if(span_formatted_address.text() == "") {
		var location_destination = span_postalcode.text() + ' ' +  span_number.text() + ' ' + span_city.text();
	} else {
	    var location_destination = span_formatted_address.text();
	}

	var locationinput = $('input#origin-input'),
		controlGroupTarget = $('div#controlGroupTarget'),
		locationError = $('span#locationError');
	console.log(locationMarker);

	maps_class.init(document.getElementById("map_canvas")).done( 
		function(){ // als google maps klaar is
			// console.log("klaar");

			// console.log( locationMarker.data('lat'));
			// console.log( locationMarker.data('lng'));

			maps_class.createMarker({
				id: locationMarker.data('id'),
				name: locationMarker.data('name'),
				formatted_address: location_destination,
				img: locationMarker.data('markerimg'),
				latitude: locationMarker.data('lat'),
				longitude: locationMarker.data('lng'),
			});

			// console.log( locationMarker.data('lat'));
			// console.log( locationMarker.data('lng'));

			maps_class.centerTo(locationMarker.data('lat'), locationMarker.data('lng'));
			maps_class.changeZoom(14);
			// console.log("hi");
		}
	);

	locationMarker.on('click', function(){
		maps_class.centerTo(locationMarker.data('lat'), locationMarker.data('lng'));
		maps_class.changeZoom(14);
	});

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
		number: function() {
			return $(this).attr('data-score');
		},
		readOnly: true,
		half: true,
		path: BASE + 'img',
		hints: ['Zeer slecht', 'Slecht', 'Acceptabel', 'Goed', 'Zeer goed']
	});
	
	$('.rating-read-only-list').raty({
		score: function() {
			return $(this).attr('data-score');
		},
		readOnly: true,
		half: true,
		path: BASE + 'img',
		hints: ['Zeer slecht', 'Slecht', 'Acceptabel', 'Goed', 'Zeer goed']
	});

	

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

				curPlaceLat = results.results[0].geometry.location.lat;
				curPlaceLng = results.results[0].geometry.location.lng

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

		if(curPlaceLat == undefined){
			controlGroupTarget.addClass("error");
			locationError.show();
		} else {
			controlGroupTarget.removeClass("error");
			locationError.hide();
		}

		var location_origin = $('#origin-input').val();

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



				maps_class.renderDirections(curPlaceLat, curPlaceLng, locationMarker.data('lat'), locationMarker.data('lng'), transport_mode);

				if(slideIn){
					hide_map.trigger('click');
				}
				htmlbody.animate({scrollTop:0}, 'slow');

			},
			function(){ //failed
				console.log("Something went wrong during the ajax request.");
				maps_locations.deferred.reject();
			}
		);

	});


	// toggle map functionalitijd
	var hide_map = $('div#hide_map');
	var hide_map_i = hide_map.children('i');
	var mapWrapper = $('div#mapWrapper');
	console.log(mapWrapper);
	var map = $('div#map_canvas');
	var map_overlay = $('div#map_overlay');
	var slideIn = true;

	hide_map.on('click', function(){
		console.log(slideIn);
		console.log(map);
		console.log(map_overlay);
		if(!slideIn){
			mapWrapper.animate({
				height: '50px'
			}, 1000, function() {
				hide_map_i.removeClass('icon-caret-up');
				hide_map_i.addClass('icon-caret-down');
			});
			map_overlay.fadeIn();
		} else {
			mapWrapper.animate({
				height: '450px'
			}, 1000, function() {
				hide_map_i.removeClass('icon-caret-down');
				hide_map_i.addClass('icon-caret-up');
			});
			map_overlay.fadeOut();
			maps_class.resizeMap();
		}
		slideIn = !slideIn;
	});


});