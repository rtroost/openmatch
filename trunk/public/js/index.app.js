var htmlbody = $('html, body');
var loadedData = [];

var indexApp = angular.module('indexApp', ['ngResource']);
angular.module('indexApp').value('$anchorScroll', angular.noop);

indexApp.config(function($routeProvider, $locationProvider){
	$routeProvider
	.when('/', { //TOON
		templateUrl: window.BASE + "js/jstemplates/toon.html",
		controller: "tableCtrl",
		resolve: {
			loadData: tableCtrl.loadData
		}
	})
	.when('/locatie_dichtbij', {
		templateUrl: window.BASE + "js/jstemplates/locatie_dichtbij.html",
		controller: "tableCtrl",
		resolve: {
			loadData: tableCtrl.loadData
		},
	})
	.when('/hoogst_beoordeeld', {
		templateUrl: window.BASE + "js/jstemplates/hoogst_beoordeeld.html",
		controller: "tableCtrl",
		resolve: {
			loadData: tableCtrl.loadData
		},
	})
	.when('/aanbevolen', {
		templateUrl: window.BASE + "js/jstemplates/aanbevolen.html",
		controller: "tableCtrl",
		resolve: {
			loadData: tableCtrl.loadData
		},
	});
});

indexApp.run(function($rootScope, $resource) {
	$rootScope.locationsByDinstance = $resource(window.BASE + 'locations',
		{callback: 'JSON_CALLBACK', action: "LOCATIE_DICHTBIJ", lat: "false", lng: "false"},
		{get: {method:'GET', isArray: true}}
	);

	$rootScope.getLocationsByDinstance = function(){
		$rootScope.locationsByDinstance.get({lat: $rootScope.curPlaceLat, lng: $rootScope.curPlaceLng},
		function(results){
			// console.log(results);
			removeCurLocatie_dichtbij();
			loadedData.push({type: "locatie_dichtbij", result: results});
			$rootScope.result = results;
			$rootScope.loading = false;
			$rootScope.oldCurPlaceLat = $rootScope.curPlaceLat;
			addRatyJQuery($rootScope.result);
		}, function() {
			console.log("error");
		});
	};
});

var tableCtrl = indexApp.controller("tableCtrl", function($scope, $rootScope, $route, $location, $resource) {
	// $rootScope.$on("$routeChangeStart", function(event, current, previous, rejection) {
	// 	console.log("routeChangeStart");
	// 	console.log($scope, $rootScope, $route, $location);
	// });
	// $rootScope.$on("$routeChangeSuccess", function(event, current, previous, rejection) {
	// 	console.log("routeChangeSuccess");
	// 	console.log($scope, $rootScope, $route, $location);
	// });
	// $rootScope.$on("$routeChangeError", function(event, current, previous, rejection) {
	// 	console.log(event);
	// 	console.log(current);
	// 	console.log(previous);
	// 	console.log(rejection);
	// });

	$scope.sortingOrder = "distance";
    $scope.reverse = false;

	$scope.Math = window.Math;
	$scope.location = ($location.path().substr(1) != '' && $location.path().substr(1) == "locatie_dichtbij") ? true : false;

	$scope.getGeoLocation = function(scope) {

		var successCallback = function( results ) {
			if(results.status === 'OK'){
				scope.$apply(function () {
					scope.geoloading = false;
					//WORKAROUND TOTDAT LARAVEL 4 ER IS
					$('div#controlGroupTarget').removeClass("error");
					//ENDWORKAROUND
					scope.error = "";
					scope.geoLocation = results.results[0].formatted_address;

					$rootScope.oldCurPlaceLat = $rootScope.curPlaceLat;
					$rootScope.oldCurPlaceLng = $rootScope.curPlaceLng;

					$rootScope.curPlaceLat = results.results[0].geometry.location.lat;
					$rootScope.curPlaceLng = results.results[0].geometry.location.lng;
					console.log("Lat = " + results.results[0].geometry.location.lat);
					console.log("Lng = " + results.results[0].geometry.location.lng);

					maps_class.removeMarker(-1);

					maps_class.createMarker({
						id: -1,
						name: "Jouw adres",
						formatted_address: results.results[0].formatted_address,
						img: 'pin-destination',
						latitude: results.results[0].geometry.location.lat,
						longitude: results.results[0].geometry.location.lng
					}, false);

					maps_class.centerTo(results.results[0].geometry.location.lat, results.results[0].geometry.location.lng);
					maps_class.changeZoom(14);

					htmlbody.animate({scrollTop:0}, 'slow');

					//$rootScope.loading = true;
					if($rootScope.path == "locatie_dichtbij"){
						$rootScope.getLocationsByDinstance();
						return;
					}
					calcDistanceLocations($rootScope.result, $rootScope.curPlaceLat, $rootScope.curPlaceLng);
				});
			} else if(results.status === 'ZERO_RESULTS') {
				scope.$apply(function () {
					//WORKAROUND TOTDAT LARAVEL 4 ER IS
					$('div#controlGroupTarget').addClass("error");
					//ENDWORKAROUND
					scope.error = "error";
				});	
			}
		}

		var failedCallback = function () { console.log("Something went wrong during the ajax request."); }

		getLocationGoogleMaps(scope.geoLocation, successCallback, failedCallback);
	}

	$scope.submit = function(scope){
		scope.getGeoLocation( scope );
	}

	$scope.changeRoute = function(newlocation){
		console.log(newlocation);
		$scope.location = (newlocation == "locatie_dichtbij") ? true : false;
		$location.path("/" + newlocation).replace();
	}

	$scope.centerTo = function(lat, lng){
		console.log(lat);
		console.log(lng);
		maps_class.centerTo(lat, lng);
		maps_class.changeZoom(14);

	}

});

tableCtrl.loadData = function($q, $timeout, $rootScope, $location, $resource) {
	$rootScope.loading = true;
	$rootScope.path = ($location.path().substr(1) != '') ? $location.path().substr(1) : "toon" ;
	var temppath = ($location.path().substr(1) != '') ? $location.path().substr(1) : "toon" ;

	if($rootScope.path == "locatie_dichtbij" && getResult($rootScope.path)) { if($rootScope.curPlaceLat != $rootScope.oldCurPlaceLat){ $rootScope.getLocationsByDinstance(); return; } } 

	if(!getResult($rootScope.path)){

		if($rootScope.path == "locatie_dichtbij") { if($rootScope.curPlaceLat !== undefined && $rootScope.curPlaceLat != $rootScope.oldCurPlaceLat){ $rootScope.getLocationsByDinstance(); return; } else { return; }  }
		$rootScope.getData = $resource(window.BASE + 'locations',
			{callback: 'JSON_CALLBACK', action: $rootScope.path.toUpperCase()},
			{get: {method:'GET', isArray: true}}
		);
		$rootScope.getData.get(function(results){
			console.log(results);
			if(temppath != $rootScope.path){ return; }
			if(temppath != "toon"){
				loadedData.push({type: temppath, result: results});
			}
			$rootScope.result = results;
			if($rootScope.curPlaceLat != undefined){
				calcDistanceLocations($rootScope.result, $rootScope.curPlaceLat, $rootScope.curPlaceLng);
			}
			$rootScope.loading = false;
			addRatyJQuery($rootScope.result);
		}, function() {
			console.log("error");
		});
	} else {
		$rootScope.result = getResult($rootScope.path).result;
		if($rootScope.curPlaceLat != undefined){
			calcDistanceLocations($rootScope.result, $rootScope.curPlaceLat, $rootScope.curPlaceLng);
		}
		$rootScope.loading = false;
		addRatyJQuery($rootScope.result);
	}
	return;
};

function getResult(t){
	for(var i in loadedData){
		if(loadedData[i].type == t){
			return loadedData[i];
		}
	}
	return false;
}

function removeCurLocatie_dichtbij(){
	for(var i in loadedData){
		if(loadedData[i].type == "locatie_dichtbij"){
			loadedData.splice(loadedData.indexOf(loadedData[i]), 1);
		}
	}
}

function calcDistanceLocations(locations, curPlaceLat, curPlaceLng){
	for(var i in locations){
		var location = locations[i];
		location.distance = calcDistance(location.latitude, location.longitude, curPlaceLat, curPlaceLng);
	}
}

indexApp.filter('formatAddress', function(){
	return function(formatted_address, postalcode, number, city){
		if(formatted_address != '') {
			return formatted_address;
		} else {
			return postalcode + ' ' + number + ' ' + city;
		}
	};
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

addRatyJQuery = function(locations){
    setTimeout(function(){
        for(var i in locations){
        	var tableWrapper = $('table#locationWrapper');
            var div = tableWrapper.find('div.location'+locations[i].id);
            div.raty({
                score: function() {
                    return locations[i].score;
                },
                readOnly: true,
                half: true,
                path: BASE + 'img',
                hints: ['Zeer slecht', 'Slecht', 'Acceptabel', 'Goed', 'Zeer goed']
            });
        }
    }, 10);
}
