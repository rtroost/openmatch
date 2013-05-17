//WORKAROUND TOTDAT LARAVEL 4 ER IS
$("#filter_location-range").change( function() {
	$("#filter_location-range-value").html($(this).val() + ' km');
});
//ENDWORKAROUND

var locationApp = angular.module('locationApp', ['ngResource']);

var locationCtrl = function LocationCtrl($scope, $resource, $rootScope) {

	$rootScope.BASE = window.BASE;
	$scope.searchTypes = [];
	$scope.searchRange = 0;

	$scope.locationsGet = $resource(window.BASE + 'locations',
		{callback: 'JSON_CALLBACK'},
		{get: {method:'GET', isArray: true}}
	);
	$scope.locations = $scope.locationsGet.get();

	$scope.toggleType = function(typesArray, type){
		if(typesArray.indexOf(type) != -1) {
			typesArray.splice(typesArray.indexOf(type), 1);
		} else {
			typesArray.push(type);
		}
	}

	$scope.testtest = function(){
		console.log("testtest");
		console.log($scope.error);
	}

	$scope.getGeoLocation = function(scope) {

		if(scope.geoLocation !== "" && scope.geoLocation !== undefined){
			$.ajax({
				type: "GET",
				url: 'http://maps.googleapis.com/maps/api/geocode/json?address=' + encodeURIComponent(scope.geoLocation) + '&sensor=false',
				dataType: 'json'
			}).promise().then( function (results){ successCallback(results); }, failedCallback );
		} else {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					$.ajax({
						type: "GET",
						url: 'http://maps.googleapis.com/maps/api/geocode/json?address=' + position.coords.latitude + "," + position.coords.longitude + '&sensor=false',
						dataType: 'json'
					}).promise().then( successCallback,	failedCallback );
				});
			} else {
				alert('Geolocation is not supported by this browser.');
			}
		}

		var successCallback = function( results ) {
			if(results.status === 'OK'){
				scope.$apply(function () {
					//WORKAROUND TOTDAT LARAVEL 4 ER IS
					$('div#controlGroupTarget').removeClass("error");
					//ENDWORKAROUND
					scope.error = "";
					scope.geoLocation = results.results[0].formatted_address;

					scope.curPlaceLat = results.results[0].geometry.location.lat;
					scope.curPlaceLng = results.results[0].geometry.location.lng;
					console.log("Lat = " + results.results[0].geometry.location.lat);
					console.log("Lng = " + results.results[0].geometry.location.lng);
				});
			} else if(results.status === 'ZERO_RESULTS') {
				scope.$apply(function () {
					//WORKAROUND TOTDAT LARAVEL 4 ER IS
					$('div#controlGroupTarget').addClass("error");
					//ENDWORKAROUND
					scope.error = "error";
					scope.testtest();
				});	
			}
		}

		var failedCallback = function () { console.log("Something went wrong during the ajax request."); }
	}

	$scope.rangeChange = function(scope){
		scope.rangenotset = (scope.curPlaceLat == undefined || scope.curPlaceLng == undefined) ? true : false;
	}

	$scope.submit = function(scope){
		scope.getGeoLocation( scope );
	}

};



var locationDirective = locationApp.directive("locations", function() {
	return {
		restrict: "E",
		replace: true,
		templateUrl: window.BASE + "js/jstemplates/locations.html",
	}
});

// var controlGroupDirective = locationApp.directive("controlgroup", function() {
// 	return {
// 		restrict: "E",
// 		transclude: true,
// 		replace: true,
// 		scope: {
// 			test: "&"
// 		},
// 		template: '<div ng-transclude class="{{test}}"></div>',
// 		link: function(){
// 			console.log("hi");
// 		}
// 	}
// });

locationApp.filter("createLink", function() {
	return function(id) {
		return window.BASE + "location/" + id;
	}
});

locationApp.filter("typesToString", function() {
	return function(types) {
		var string = "";
		for(i in types){
			string += types[i] + ", ";
		}
		return string.substr(0, string.length - 2);
	}
});

locationApp.filter("filterTypes", function() {
	return function(items, searchTypes) {

		if(searchTypes.length == 0){ return items; }

		var arrayToReturn = [];
		for (var i=0; i < items.length; i++){
			for(var j in searchTypes){
				if (items[i].types.indexOf(searchTypes[j]) != -1) {
					arrayToReturn.push(items[i]);
				}
			}
			
		}

		return arrayToReturn;
	}
});

locationApp.filter("filterRange", function() {
	return function(items, obj) {
		if(obj.searchRange == 0 || obj.lat == undefined || obj.lng == undefined){ return items; }

		var arrayToReturn = [];  
		for (var i=0; i < items.length; i++){
			var distance = Math.round(calcDistance(obj.lat, obj.lng, items[i].lat, items[i].lng));
			if(distance <= obj.searchRange){
				arrayToReturn.push(items[i]);
			}
		}

		return arrayToReturn;
	}
});

calcDistance = function(lat1, lng1, lat2, lng2){

	var deg2rad = function(deg) {
		return deg * (Math.PI/180);
	}

	var R = 6371; // Radius of the earth in km
	var dLat = deg2rad(lat2-lat1);  // deg2rad below
	var dLon = deg2rad(lng2-lng1);
	var a = 
		Math.sin(dLat/2) * Math.sin(dLat/2) +
		Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
		Math.sin(dLon/2) * Math.sin(dLon/2)
	; 
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
	var d = R * c; // Distance in km
	return d;

}

	