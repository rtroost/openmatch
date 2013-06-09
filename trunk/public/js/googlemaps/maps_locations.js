var maps_locations = {

	getLocations: function(){
		return (maps_locations.Locations !== undefined) ? maps_locations.Locations : null;
	},

	loadLocations: function(){
		maps_locations.deferred = new $.Deferred();
		$.ajax({
			url: BASE + 'locations',
			data: {'action': 'geo'},
			dataType: 'json'
		}).promise().then(
			function( results ){ //success
				maps_locations.Locations = results;
				maps_locations.deferred.resolve();
			},
			function(){ //failed
				console.log("Something went wrong during the ajax request.");
				maps_locations.deferred.reject();
			}
		);
		return maps_locations.deferred.promise();
	},

	placeAllLocations: function(){
		for(var pos in maps_locations.Locations){
			// console.log(maps_locations.Locations[pos]);

			// kan er ook handmatig een object van maken
			maps_class.createMarker(maps_locations.Locations[pos]);
		}
		return;
	}
};
