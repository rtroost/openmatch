var maps_class = {

	init: function(config) {
		this.IMGLOC = location.pathname + "img/";
		this.IMGMAPSLOC = this.IMGLOC + "maps/";

		this.positions = config['positions'];
		this.container = config['container'];
		this.markers = [];

		google.maps.event.addDomListener(window, 'load', this.initialize);
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

		var infowindow = new google.maps.InfoWindow();

		var mapOptions = {
			center: new google.maps.LatLng(51.92422, 4.48178),
			zoom: 14,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		self.map = new google.maps.Map(self.container, mapOptions);

		for (var pos in self.positions) {

			pos = self.positions[pos];
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(pos['lng'], pos['lat']),
				map: self.map,
				title: pos['text'],
				icon: self.IMGMAPSLOC + pos['img'] + '.png',
				shadow: self.IMGMAPSLOC + 'icon-shadow.png'
			});

			var contentInfowindow = '<h2>' + pos['text'] + '</h2><p>Hier de content. Met wat leuke tekst erin</p><a href="#">Meer informatie</a>';

			self.makeInfoWindowEvent(self.map, infowindow, contentInfowindow, marker);

			self.markers.push(marker);

		}

	},

	makeInfoWindowEvent: function(map, infowindow, contentString, marker) {

		var self = maps_class;

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(contentString);
			infowindow.open(self.map, marker);
			self.map.setCenter(marker.getPosition());
		});
	}

}