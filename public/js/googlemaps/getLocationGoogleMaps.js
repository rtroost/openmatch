function getLocationGoogleMaps(input, successCallback, failedCallback){

	if(input !== "" && input !== undefined){
		$.ajax({
			type: "GET",
			url: 'http://maps.googleapis.com/maps/api/geocode/json?address=' + encodeURIComponent(input) + '&sensor=false',
			dataType: 'json'
		}).promise().then( function (results){ successCallback(results); }, failedCallback );
	} else {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				$.ajax({
					type: "GET",
					url: 'http://maps.googleapis.com/maps/api/geocode/json?address=' + position.coords.latitude + "," + position.coords.longitude + '&sensor=false',
					dataType: 'json'
				}).promise().then( successCallback,	failedCallback );
			});
		} else {
			alert('Geolocation is not supported by this browser.');
		}
	}
}