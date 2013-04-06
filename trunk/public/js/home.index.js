$(document).ready(function() {

	// Google maps api starten
	maps_class.init(document.getElementById("map_canvas")).done( 
		function(){ // als google maps klaar is

			// Haal alle locations op uit de database
			maps_locations.loadLocations().done(
				function(){ // als het ophalen uit de databse klaar is

					// start het location filter systeem
					location_filter.init(
						$('ul#filter'), 				// geef de ul met de chekboxes mee
						maps_locations.getLocations(), 	// geef alle locations mee
						maps_class.hideMarker, 			// geef een weghaal functie mee
						maps_class.displayMarker 		// geen een weergeef functie mee
					);

					// plaats alle locations
					maps_locations.placeAllLocations();
				}
			);
		}
	);

	// zoeken slider functionalitijd
	var zoekenInner = $('div#map_overlay_inner');
	var zoekenHeader = $('div#map_overlay_inner_header');
	var slide = false;
	zoekenHeader.on('click', function(){
		if(!slide){
			slide = true;
			zoekenInner.slideToggle('normal', function() {
				slide = false;
			});
		}
	});

});