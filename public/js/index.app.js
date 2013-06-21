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
			console.log(results);
			loadedData.push({type: "locatie_dichtbij", result: results});
			$rootScope.result = results;
			$rootScope.loading = false;
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

    $scope.geoloading = true;

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
					$rootScope.error = "";
					scope.geoLocation = results.results[0].formatted_address;

					$rootScope.curPlaceLat = results.results[0].geometry.location.lat;
					$rootScope.curPlaceLng = results.results[0].geometry.location.lng;
					console.log("Lat = " + results.results[0].geometry.location.lat);
					console.log("Lng = " + results.results[0].geometry.location.lng);

					// zet een marker op de map
					// centreer de maps daar naar toe

					maps_class.removeMarker(-1);

					maps_class.createMarker({
						id: -1,
						name: "Jouw adres",
						formatted_address: results.results[0].formatted_address,
						img: 'iconSwimming',
						latitude: results.results[0].geometry.location.lat,
						longitude: results.results[0].geometry.location.lng
					}, false);

					$rootScope.loading = true;
					$rootScope.getLocationsByDinstance();
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

	

});

tableCtrl.loadData = function($q, $timeout, $rootScope, $location, $resource) {
	$rootScope.loading = true;
	var path = ($location.path().substr(1) != '') ? $location.path().substr(1) : "toon" ;
	// console.log(getResult(path));
	if(!getResult(path)){
		if(path == "locatie_dichtbij") { return; }
		$rootScope.getData = $resource(window.BASE + 'locations',
			{callback: 'JSON_CALLBACK', action: path.toUpperCase()},
			{get: {method:'GET', isArray: true}}
		);
		$rootScope.getData.get(function(results){
			console.log(results);
			loadedData.push({type: path, result: results});
			$rootScope.result = results;
			$rootScope.loading = false;
		}, function() {
			console.log("error");
		});
	} else {
		$rootScope.result = getResult(path).result;
		$rootScope.loading = false;
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

indexApp.filter('formatAddress', function(){
	return function(formatted_address, postalcode, number, city){
		if(formatted_address != '') {
			return formatted_address;
		} else {
			return postalcode + ' ' + number + ' ' + city;
		}
	};
});