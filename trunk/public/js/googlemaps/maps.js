var maps_class = {

	init: function(config) {

		this.deferred = new $.Deferred();

		this.container = config;
		this.markers = {};

		google.maps.event.addDomListener(window, 'load', this.initialize);

		return this.deferred.promise();

	},

	initialize: function() {

		var self = maps_class;

		var image = new google.maps.MarkerImage('marker.png',
		new google.maps.Size(65, 124),
		new google.maps.Point(0, 0),
		new google.maps.Point(56, 122));

		var shadow = new google.maps.MarkerImage('marker_shadow.png',
		new google.maps.Size(96, 59),
		new google.maps.Point(0, 0),
		new google.maps.Point(32, 59));

		self.infowindow = new google.maps.InfoWindow();

		var mapOptions = {
			center: new google.maps.LatLng(51.92422, 4.48178),
			zoom: 14,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		self.map = new google.maps.Map(self.container, mapOptions);
		if(self.map){
			self.deferred.resolve();
		} else {
			self.deferred.reject();
		}
	},

	createMarker: function(pos){
		var self = maps_class;
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(pos['lat'], pos['lng']),
			map: self.map,
			title: pos['text'],
			icon: IMGLOC + "maps/" + pos['img'] + '.png',
			shadow: IMGLOC + "maps/" + 'icon-shadow.png'
		});

		var contentInfowindow = '<h4>' + pos['title'] + '</h4><a href="' + BASE + 'location/' + pos['location_id'] + '">Lees meer</a>';
		if(pos['website'] !== null){
			contentInfowindow += '<a href="' + pos['website'] + '">Website</a>';
		}

		self.makeInfoWindowEvent(self.map, self.infowindow, contentInfowindow, marker);

		self.markers[pos['location_id']] = marker;
	},

	makeInfoWindowEvent: function(map, infowindow, contentString, marker) {

		var self = maps_class;

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(contentString);
			infowindow.open(self.map, marker);
			self.map.setCenter(marker.getPosition());
		});
	},

	hideMarker: function(id){
		var self = maps_class;
		self.markers[id].setVisible(false);
	},

	displayMarker: function(id){
		var self = maps_class;
		self.markers[id].setVisible(true);
	}

};