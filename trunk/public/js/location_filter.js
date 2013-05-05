var location_filter = {

	init: function(ul, locations, hideFunction, displayFunction, rangeFilterInput){
		this.ul = ul;
		this.rangeFilterInput = rangeFilterInput;
		this.locations = locations;
		this.hideFunction = hideFunction;
		this.displayFunction = displayFunction;

		this.checked = [];

		this.bindEvents();
	},

	bindEvents: function(){
		var self = location_filter;
		self.ul.on('change', 'li', self.filter);
		if(self.rangeFilterInput != undefined){
			self.rangeFilterInput.on('change', self.filterRange);
		}
	},

	filter: function(){
		var self = location_filter,
			$this = $(this),
			checkbox = $this.find('input');

		if(checkbox.is(':checked')){
			self.checked.push(checkbox.attr('value'));
		} else {
			self.checked.splice( $.inArray(checkbox.attr('value'), self.checked) ,1 );
			
			for (var i in self.locations) {
				self.locations[i].visible = true;
				self.displayFunction(self.locations[i]['location_id']);
			}

			if(self.rangeFilterInput != undefined){
				self.rangeFilterInput.trigger('change');
			}
			if(self.checked.length == 0){
				return;
			}
		}

		// console.log("self.checked " + self.checked);
		// console.log(self.checked.length);

		for (var i in self.locations) {
			var location = self.locations[i];
			if(!location.visible){ continue; }

			var hide = [];
			for (var k in location['types']) {
				//console.log(location['types'][k]);
				if(self.checked.indexOf(location['types'][k]) != -1){
					hide.push("true");
				} else {
					hide.push("false");
				}
			}
			//console.log(hide);

			if(self.checked.length >= 2){
				if(hide[0] == "true" && hide[1] == "true"){

				} else {
					location.visible = false;
					self.hideFunction(location['location_id']);
				}
			} else if(self.checked.length == 1){
				if(hide[0] == "true" || hide[1] == "true"){

				} else {
					location.visible = false;
					self.hideFunction(location['location_id']);
				}
			}
		}
		if(self.rangeFilterInput != undefined){
			self.rangeFilterInput.trigger('change');
		}

	},

	filterRange : function() {
		var self = location_filter,
			$this = $(this);

		// console.log(window.curPlaceLat);
		// console.log(window.curPlaceLng);

		if(window.curPlaceLat == undefined && window.curPlaceLng == undefined){ return; }

		var filterKm = $this.val();
		//console.log(filterKm);

		for (var i in self.locations) {
			var location = self.locations[i];
			if(!location.visible){ continue; }

			var distance = Math.round(self.calcDistance({'lat': location.lat, 'lng': location.lng}, {'lat': window.curPlaceLat, 'lng': window.curPlaceLng}));
			if( distance > filterKm){
				self.hideFunction(location.location_id);
			} else {
				self.displayFunction(location.location_id);
			}

		}
	},

	calcDistance: function(point1, point2){
		if(typeof(point1) !== 'object' && typeof(point1) !== 'object'){ return; }
		var self = location_filter;

		var R = 6371; // Radius of the earth in km
		var dLat = self.deg2rad(point2.lat-point1.lat);  // deg2rad below
		var dLon = self.deg2rad(point2.lng-point1.lng);
		var a = 
			Math.sin(dLat/2) * Math.sin(dLat/2) +
			Math.cos(self.deg2rad(point1.lat)) * Math.cos(self.deg2rad(point2.lat)) * 
			Math.sin(dLon/2) * Math.sin(dLon/2)
		; 
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		var d = R * c; // Distance in km
		return d;

	},

	deg2rad: function(deg) {
		return deg * (Math.PI/180);
	}

};
