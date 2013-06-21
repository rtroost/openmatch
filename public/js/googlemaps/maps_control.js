// var maps_control = {

// 	init: function(){
// 		maps_class.init({
// 			'container' : document.getElementById("map_canvas")
// 		}).then(
// 			maps_control.getPositions, //success
// 			function(){ //failed
// 				console.log("Google maps is not proper loaded.");
// 				return;
// 			}
// 		);

// 	},

// 	getPositions: function(){
// 		$.ajax({
// 			url: BASE + 'locations',
// 			dataType: 'json'
// 		}).promise().then(
// 			function( results ){
// 				maps_control.positions = results;
// 				console.log(results);
// 				maps_control.placeAllPositions();
// 			},
// 			function(){
// 				console.log("Something went wrong during the ajax request.");
// 			}
// 		);
// 	},

// 	placeAllPositions: function(){
// 		var self = maps_control;

// 		for(var pos in self.positions){
// 			maps_class.createMarker(self.positions[pos], "true");
// 		}
// 		return;
// 	}
// };
