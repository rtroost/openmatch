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
				position: new google.maps.LatLng(pos['lat'], pos['lng']),
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

};

(function( $ ){

	maps_class.init({
	'positions' : [{
		'lat': 51.92479,
		'lng': 4.46869,
		'text': 'Centraal Station',
		'img': 'travel'
	}, {
		'lat': 51.91701,
		'lng': 4.48405,
		'text': 'Hogeschool Rotterdam',
		'img': 'education'
	}, {
		'lat': 51.919753600882,
		'lng': 4.5019220984303,
		'text': 'Tropicana',
		'img': 'sports'
	}],
	'container' : document.getElementById("map_canvas")
	});

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
})( jQuery );