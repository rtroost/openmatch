var location_filter = {

	init: function(ul, locations, hideFunction, displayFunction){
		this.ul = ul;
		this.index = locations;
		this.hideFunction = hideFunction;
		this.displayFunction = displayFunction;

		this.checked = [];

		this.bindEvents();
	},

	bindEvents: function(){
		var self = location_filter;
		self.ul.on('change', 'li', self.filter);
	},

	filter: function(){
		var self = location_filter,
			$this = $(this),
			checkbox = $this.find('input');

		if(checkbox.is(':checked')){
			self.checked.push(checkbox.attr('value'));
		} else {
			self.checked.splice( $.inArray(checkbox.attr('value'), self.checked) ,1 );
		}

		for (var i in self.index) {
			var location = self.index[i];
			self.hideFunction(location['location_id']);

			for (var j in location['types']) {
				var loc_type = location['types'][j];

				for (var k in self.checked) {
					var check = self.checked[k];
					if(check == loc_type){
						self.displayFunction(location['location_id']);
						break;
					}
				};

			};

		};

	}

};
