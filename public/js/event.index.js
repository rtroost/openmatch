$(document).ready(function() {

	var locations;
	var template = Handlebars.compile( $("#locationRow").html() );
	var locationWrapper = $("#locationWrapper");

	// Haal alle locations op uit de database
	loadLocations().done(
		function(){ // als het ophalen uit de databse klaar is
			placeLocations();

			// start het location filter systeem
			location_filter.init(
				$('ul#locationfilter'),			// geef de ul met de chekboxes mee
				locations,						// geef alle locations mee
				hideRow,						// geef een weghaal functie mee
				showRow							// geen een weergeef functie mee
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
		}
	}

	function hideRow(id){
		locationWrapper.children('li#'+id).hide();
	}

	function showRow(id){
		locationWrapper.children('li#'+id).show();
	}

});