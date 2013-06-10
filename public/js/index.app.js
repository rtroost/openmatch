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

var tableCtrl = indexApp.controller("tableCtrl", function($scope, $rootScope, $route, $location) {
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

	$scope.changeRoute = function(newlocation){
		console.log(newlocation);
		$location.path("/" + newlocation).replace();
	}

});

tableCtrl.loadData = function($q, $timeout, $rootScope, $location, $resource) {
	$rootScope.loading = true;
	var path = ($location.path().substr(1) != '') ? $location.path().substr(1) : "toon" ;
	// console.log(getResult(path));
	if(!getResult(path)){

		$rootScope.getData = $resource(window.BASE + 'locations',
			{callback: 'JSON_CALLBACK', action: path.toUpperCase()},
			{get: {method:'GET', isArray: true}}
		);
		$rootScope.getData.get(function(results){
			// console.log(results);
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