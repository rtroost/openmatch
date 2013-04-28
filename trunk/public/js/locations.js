$(document).ready(function() {

	$('#get-geolocation').on('click', function() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {

				var geocoder = new google.maps.Geocoder();
				var latLng = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

				if (geocoder) {
					geocoder.geocode({'latLng': latLng}, function (results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							$('#origin-input').val(results[0].formatted_address);
						} else {
							console.log("Geocoding failed: " + status);
						}
					});
				}

			});
		} else {
			alert('Geolocation is not supported by this browser.');
		}

	});

});