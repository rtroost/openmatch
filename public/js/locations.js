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
			maps_class.createMarker({
				id: locationMarker.data('id'),
				name: locationMarker.data('name'),
				formatted_address: location_destination,
				img: locationMarker.data('markerimg'),
				latitude: locationMarker.data('lat'),
				longitude: locationMarker.data('lng'),
			});

			maps_class.centerTo(locationMarker.data('lat'), locationMarker.data('lng'));
			maps_class.changeZoom(14);
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

		var transport_mode = $('#transport-input').val();

		maps_class.renderDirections(curPlaceLat, curPlaceLng, locationMarker.data('lat'), locationMarker.data('lng'), transport_mode);

		if(slideIn)
		{
			hide_map.trigger('click');
		}
		
		htmlbody.animate({scrollTop:0}, 'slow');

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