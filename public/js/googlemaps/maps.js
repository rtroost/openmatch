var maps_class = {

	init: function(config) {

		this.deferred = new $.Deferred();

		this.container = config;
		this.markers = {};

		$.get(BASE + 'js/jstemplates/maps_marker.html', function(data){
		    maps_class.templatehtml = $(data);
		});

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
		//console.log(pos);
		var self = maps_class;
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(pos.latitude, pos.longitude),
			map: self.map,
			title: pos.name,
			icon: IMGLOC + "maps/" + pos.img + '.png',
			shadow: IMGLOC + "maps/" + 'icon-shadow.png'
		});

		var newTemplate = self.templatehtml.clone();

		newTemplate.find('h4.marker_title').text(pos.name);
		newTemplate.find('p.marker_address').text(pos.formatted_address);
		newTemplate.find('a.marker_link').attr("href", BASE + "locations/" + pos.id);

		var marker_contacts = newTemplate.find('div.marker_contacts');

		if(pos.website != null) {
			marker_contacts.append('<a href="' + pos.website + '" target="_blank"><i class="icon-globe activeLink"></i></a>');
		} else {
			marker_contacts.append('<a href="#" target="_blank" data-toggle="tooltip" title="Website"><i class="icon-question"></i></a>');
		}
		if(pos.tel != null) {
			marker_contacts.append('<a href="tel:' + pos.tel + '" data-toggle="tooltip" title="' + pos.tel + '" target="_blank"><i class="icon-phone activeLink"></i></a>');
		} else {
			marker_contacts.append('<a href="#" target="_blank" data-toggle="tooltip" title="Telefoonnummer"><i class="icon-question"></i></a>');
		}
		if(pos.email != null) {
			marker_contacts.append('<a href="emailto:' + pos.email + '" data-toggle="tooltip" title="' + pos.email + '"><i class="icon-envelope activeLink"></i></a>');
		} else {
			marker_contacts.append('<a href="#" target="_blank" data-toggle="tooltip" title="Email"><i class="icon-question"></i></a>');
		}

		var contentInfowindow = newTemplate.html();

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