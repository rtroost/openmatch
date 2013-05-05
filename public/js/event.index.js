$(document).ready(function() {

	var locations;
	var template = Handlebars.compile( $("#locationRow").html() );
	var locationWrapper = $("#locationWrapper");
	var index = {};

	// Haal alle locations op uit de database
	loadLocations().done(
		function(){ // als het ophalen uit de databse klaar is
			placeLocations();

			// start het location filter systeem
			location_filter.init(
				$('ul#locationfilter'),			// geef de ul met de chekboxes mee
				locations,						// geef alle locations mee
				hideRow,						// geef een weghaal functie mee
				showRow,						// geef een weergeef functie mee
				$("#filter_location-range")// geef het range filter mee
			);

		}
	);

	function loadLocations(){
		var deferred = new $.Deferred();
		$.ajax({
			url: BASE + 'locations',
			dataType: 'json'
		}).promise().then(
			function( results ){ //success
				locations = results;
				deferred.resolve();
			},
			function(){ //failed
				console.log("Something went wrong during the ajax request.");
				deferred.reject();
			}
		);
		return deferred.promise();
	}

	function placeLocations(){
		//console.log(locations);

		for (var i in locations) {
			locationWrapper.append( template(locations[i]) );
			index[locations[i]['location_id']] = locationWrapper.children('li#'+locations[i]['location_id']);
		}

		console.log(index);
	}

	function hideRow(id){
		index[id].hide();
	}

	function showRow(id){
		index[id].show();
	}

});