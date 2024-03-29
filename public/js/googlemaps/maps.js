var maps_class = {

	init: function(config) {

		this.templatehtml = $('<div class="marker_wrapper"><h4 class="marker_title"></h4><p class="marker_address"></p><a class="marker_link" href="">Lees meer</a><div class="marker_contacts"></div></div>');

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

		self.directionsService = new google.maps.DirectionsService();

		self.directionsDisplay = new google.maps.DirectionsRenderer({
			draggable: true
		});
		
		self.directionsPanel = document.getElementById("directionsPanel");
		
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
		
		self.directionsDisplay.setMap(self.map);
  		self.directionsDisplay.setPanel(self.directionsPanel);
	},

	createMarker: function(pos, withContacts){
		// console.log(pos);
		if(pos.img == null){
			console.log(pos);
		}
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
		if(pos.formatted_address == "") {
			newTemplate.find('p.marker_address').text(pos.postalcode + ' ' + pos.number + ' ' + pos.city);
		} else {
			newTemplate.find('p.marker_address').text(pos.formatted_address);
		}
		newTemplate.find('a.marker_link').attr("href", BASE + "locations/" + pos.id);

		var marker_contacts = newTemplate.find('div.marker_contacts');

//		if(withContacts){
//			if(pos.website != null) {
//				marker_contacts.append('<a href="' + pos.website + '" target="_blank"><i class="icon-globe activeLink"></i></a>');
//			} else {
//				marker_contacts.append('<a href="#" target="_blank" data-toggle="tooltip" title="Website"><i class="icon-question"></i></a>');
//			}
//			if(pos.tel != null) {
//				marker_contacts.append('<a href="tel:' + pos.tel + '" data-toggle="tooltip" title="' + pos.tel + '" target="_blank"><i class="icon-phone activeLink"></i></a>');
//			} else {
//				marker_contacts.append('<a href="#" target="_blank" data-toggle="tooltip" title="Telefoonnummer"><i class="icon-question"></i></a>');
//			}
//			if(pos.email != null) {
//				marker_contacts.append('<a href="emailto:' + pos.email + '" data-toggle="tooltip" title="' + pos.email + '"><i class="icon-envelope activeLink"></i></a>');
//			} else {
//				marker_contacts.append('<a href="#" target="_blank" data-toggle="tooltip" title="Email"><i class="icon-question"></i></a>');
//			}
//		} else {
//			newTemplate.find('div.marker_contacts').remove();
//			newTemplate.find('a.marker_link').remove();
//		}

		var contentInfowindow = newTemplate.html();

		self.makeInfoWindowEvent(self.map, self.infowindow, contentInfowindow, marker);

		self.markers[pos.id] = marker;
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
	},

	removeMarker: function(id){
		var self = maps_class;
		if(self.markers[id] !== undefined){
			self.markers[id].setMap(null);
		}
	},

	centerTo: function(lat, lng){
		var self = maps_class;
		//console.log(marker.getPosition());
		self.map.setCenter(new google.maps.LatLng(lat, lng));
	},

	changeZoom: function(level){
		var self = maps_class;
 		self.map.setZoom(level);
	},

	resizeMap: function(){
		var self = maps_class;
		google.maps.event.trigger(self.map, 'resize');
	},

	renderDirections: function(lat1, lng1, lat2, lng2, mode){
		var self = maps_class;
		var start = new google.maps.LatLng(lat1, lng1);
		var end = new google.maps.LatLng(lat2, lng2);

		self.directionsDisplay.setMap(self.map); // map should be already initialized.

		console.log(mode);

		if(mode == "DRIVING"){
			var request = {
				origin : start,
				destination : end,
				travelMode : google.maps.TravelMode.DRIVING
			};
		} else if(mode == "TRANSIT"){
			var request = {
				origin : start,
				destination : end,
				travelMode : google.maps.TravelMode.TRANSIT
			};
		} else if(mode == "WALKING"){
			var request = {
				origin : start,
				destination : end,
				travelMode : google.maps.TravelMode.WALKING
			};
		}
		
		self.directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
			    self.directionsDisplay.setDirections(response);
			}
		});

	}


};
