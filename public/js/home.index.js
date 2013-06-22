$(document).ready(function() {

	// Google maps api starten
	maps_class.init(document.getElementById("map_canvas")).done( 
		function(){ // als google maps klaar is

			// Haal alle locations op uit de database
			maps_locations.loadLocations().done(
				function(){ // als het ophalen uit de databse klaar is

					// start het location filter systeem
					location_filter.init(
						$('ul#filter'), 				// geef de ul mee
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

	// toggle map functionalitijd
	var hide_map = $('div#hide_map');
	var hide_map_i = hide_map.children('i');
	var map = $('div#map_canvas');
	var map_overlay = $('div#map_overlay');
	var slideIn = false;

	hide_map.on('click', function(){
		console.log(slideIn);
		console.log(map);
		console.log(map_overlay);
		if(!slideIn){
			map.animate({
				height: '50px'
			}, 1000, function() {
				hide_map_i.removeClass('icon-caret-up');
				hide_map_i.addClass('icon-caret-down');
				console.log("klaar");
			});
			map_overlay.animate({
				height: '50px',
			}, 1000, function() {
				console.log("klaar");
				map_overlay.css('background', 'rgba(0,0,0,0.5)');
			});
		} else {
			map.animate({
				height: '450px'
			}, 1000, function() {
				hide_map_i.removeClass('icon-caret-down');
				hide_map_i.addClass('icon-caret-up');
				console.log("klaar");
			});
			map_overlay.animate({
				height: '450px',
			}, 1000, function() {
				console.log("klaar");
				map_overlay.css('background', 'rgba(0,0,0,0)');
			});
		}
		slideIn = !slideIn;
		console.log("hi");
	});

	// // zoeken slider functionalitijd
	// var zoekenInner = $('div#map_overlay_inner');
	// var zoekenButton = $('div#map_overlay_inner_button');
	// var slideLock = false;
	// var slideVis = true;
	// var degree = 180;
	// zoekenButton.on('click', function(){
	// 	// console.log("hi");
	// 	if(!slideLock){
	// 		slideLock = true;
	// 		if(slideVis) { 
	// 			zoekenButton.css({
	// 				'transform': 'rotate(180deg)',
	// 				'-webkit-transform': 'rotate(180deg)',
	// 			});
	// 			zoekenInner.hide("slide", { direction:"down" }, 500, function(){
	// 				slideVis = false;
	// 				slideLock = false;
	// 			}); 
	// 		} else {
	// 			zoekenButton.css({
	// 				'transform': 'rotate(0deg)',
	// 				'-webkit-transform': 'rotate(0deg)',
	// 			});
	// 			zoekenInner.show("slide", { direction:"down" }, 500, function() {
	// 				slideVis = true;
	// 				slideLock = false;
	// 			});
	// 		}
	// 	}
	// });



});