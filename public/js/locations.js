$(document).ready(function() {

	var htmlbody = $('html, body');

	var ulTabs = $('ul#tab');
	var mapCanvas = $('div#map_canvas');
	var locationMarker = $('img#location-marker-img');

	var span_formatted_address = $('span.location_formatted_address');
	var span_postalcode = $('span.location_postalcode');
	var span_number = $('span.location_number');
	var span_city = $('span.location_city');

	var curPlaceLat = undefined;
	var curPlaceLng = undefined;

	var parkingPlaces = undefined;
	var toparkingplaceLabel = $('label.toparkingplace-label');
	var toparkingplaceInput = toparkingplaceLabel.find('input');
	var toparkingplaceLabelVisible = true;
	var selectTransportInput = $('select#transport-input');

	if(span_formatted_address.text() == "") {
		var location_destination = span_postalcode.text() + ' ' +  span_number.text() + ' ' + span_city.text();
	} else {
	    var location_destination = span_formatted_address.text();
	}

	var locationinput = $('input#origin-input'),
		controlGroupTarget = $('div#controlGroupTarget'),
		locationError = $('span#locationError');
	console.log(locationMarker);

	$.ajax({
		type: "GET",
		url: window.BASE + "locations",
		dataType: 'json',
		data: {action: "PARKINGPLACES", lat: locationMarker.data('lat'), lng: locationMarker.data('lng')}
	}).promise().then( function (results){ 
		console.log(results);
		parkingPlaces = results;
		console.log(parkingPlaces);

		for(var i in results){
			var result = results[i];
			maps_class.createMarker({
				id: -(result.id),
				name: result.street,
				formatted_address: result.postalcode + ' ' +  result.number + ' ' + result.city,
				img: "iconParking",
				latitude: result.latitude,
				longitude: result.longitude,
			});
		}

	}, function(){
		console.log("error");
	});

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

	console.log(selectTransportInput);
	selectTransportInput.on("change", function(){
		$this = $(this);
		console.log($this);
		console.log($this.find(":selected").val());
		if($this.find(":selected").val() == "DRIVING" && parkingPlaces.length != 0){
			toparkingplaceLabel.show();
			toparkingplaceLabelVisible = true;
		}
		if($this.find(":selected").val() !== "DRIVING"){
			toparkingplaceLabel.hide();
			toparkingplaceLabelVisible = false;
		}
	});

	$('#btn_getDirections').on('click', function(e) {

		e.preventDefault(); // Prevent form from submitting

		if(curPlaceLat == undefined){
			controlGroupTarget.addClass("error");
			locationError.show();
			return;
		} else {
			controlGroupTarget.removeClass("error");
			locationError.hide();
		}

		var transport_mode = selectTransportInput.val();

		console.log(toparkingplaceInput.prop('checked'));
		if(toparkingplaceLabelVisible && toparkingplaceInput.prop('checked') && transport_mode == "DRIVING" && parkingPlaces.length != 0){
			var parkingplace = nearestParkingPlace();
			console.log(parkingplace);
			maps_class.renderDirections(curPlaceLat, curPlaceLng, parkingplace.latitude, parkingplace.longitude, transport_mode);
		} else {
			maps_class.renderDirections(curPlaceLat, curPlaceLng, locationMarker.data('lat'), locationMarker.data('lng'), transport_mode);
		}
		
		animateMap();

		if(slideIn) {
			hide_map.trigger('click');
		}
		
		htmlbody.animate({scrollTop:0}, 'slow');

	});

	function animateMap(){
		mapCanvas.animate({
			width: '70%'
		}, 1000, function() {
			// hide_map_i.removeClass('icon-caret-up');
			// hide_map_i.addClass('icon-caret-down');
		});
	};

	function nearestParkingPlace(){
		var lowest = undefined;
		for(var i in parkingPlaces){
			var row = parkingPlaces[1];
			if(lowest == undefined){
				lowest = row;
			} else {
				if(row.distance < lowest.distance ){
					lowest = row;
				}
			}
		}
		return lowest;
	};


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