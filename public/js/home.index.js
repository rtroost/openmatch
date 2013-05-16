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
	var zoekenButton = $('div#map_overlay_inner_button');
	var slideLock = false;
	var slideVis = true;
	var degree = 180;
	zoekenButton.on('click', function(){
		// console.log("hi");
		if(!slideLock){
			slideLock = true;
			if(slideVis) { 
				zoekenButton.css({
					'transform': 'rotate(180deg)',
					'-webkit-transform': 'rotate(180deg)',
				});
				zoekenInner.hide("slide", { direction:"down" }, 500, function(){
					slideVis = false;
					slideLock = false;
				}); 
			} else {
				zoekenButton.css({
					'transform': 'rotate(0deg)',
					'-webkit-transform': 'rotate(0deg)',
				});
				zoekenInner.show("slide", { direction:"down" }, 500, function() {
					slideVis = true;
					slideLock = false;
				});
			}
		}
	});

});