$(document).ready(function() {

	$('.hasTooltip').tooltip();

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

function comment_openFeedback(comment_id) {

	$('#comment-feedback-comment_id').val(comment_id);
	$('#comment-feedback-message').val("");
	$('#comment-feedback').modal('show');
}

function comment_postFeedback() {
		$('#comment-feedback').modal('hide');

		// setup some local variables
    var $form = $('#form-comment_feedback');

    // serialize the data in the form
    var location_id = $('#comment-feedback-location_id').val();
    var comment_id = $('#comment-feedback-comment_id').val();
    var message = $('#comment-feedback-message').val();

		$.ajax({
			type: "POST",
			url: BASE + 'location/feedback/comment',
			data: {
				location_id : location_id,
				comment_id : comment_id,
				message : message,
			},
			dataType: 'json'
		}).promise().then(
			function( results ){ //success
				console.log(results);
			},
			function(){ //failed
				console.log("Something went wrong during the ajax request.");
			}
		);
	}