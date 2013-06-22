var location_filter = {

	init: function(ul, locations, hideFunction, displayFunction){
		this.ul = ul;
		this.locations = locations;
		this.hideFunction = hideFunction;
		this.displayFunction = displayFunction;

		this.checked = [];

		this.bindEvents();
	},

	bindEvents: function(){
		var self = location_filter;
		self.ul.on('click', 'li', self.filter);
	},

	filter: function(){
		var self = location_filter,
			$this = $(this);

		if(!$this.hasClass('active_marker_sort')){
			self.checked.push($this.data('type'));
			$this.addClass('active_marker_sort');
		} else {
			self.checked.splice( $.inArray($this.data('type'), self.checked) ,1 );
			$this.removeClass('active_marker_sort');
		}

		for (var i in self.locations) {
			self.displayFunction(self.locations[i].id);
		}

		if(self.checked.length == 0){
			return;
		}

		//console.log("self.checked " + self.checked);
		// console.log(self.checked.length);

		for (var i in self.locations) {
			var location = self.locations[i];

			var hide = [];

			for (var k in location.types_array) {
				if(self.checked.indexOf(location.types_array[k]) != -1){
					hide.push("true");
				} else {
					hide.push("false");
				}
			}
			//console.log(hide);

			if(hide.indexOf("true") == -1){
				// heeft geen true, moet weg
				self.hideFunction(location.id);
			}
		}

	},

};
