// //WORKAROUND TOTDAT LARAVEL 4 ER IS
// $("#filter_location-range").change( function() {
// 	$("#filter_location-range-value").html($(this).val() + ' km');
// });
// //ENDWORKAROUND

var locationApp = angular.module('locationApp', ['ngResource']);

var locationCtrl = function LocationCtrl($scope, $resource, $rootScope, $filter) {

    $scope.Math = window.Math;

	$scope.sortingOrder = "name";
    $scope.reverse = false;
    $scope.filteredItems = [];
    $scope.groupedItems = [];
    $scope.itemsPerPage = 25;
    $scope.pagedItems = [];
    $scope.currentPage = 0;
    //$scope.sort = '';
    //$scope.order = true; // true = asc, false = desc
    $scope.sortArr = {};
    $scope.distance = false;

    // ---------------

	$rootScope.BASE = window.BASE;
	$scope.searchTypes = [];
	$scope.searchRange = 0;

	$scope.locationsGet = $resource(window.BASE + 'locations',
		{callback: 'JSON_CALLBACK'},
		{get: {method:'GET', isArray: true}}
	);
	$scope.locations = $scope.locationsGet.get(function(results){
        $scope.filteredItems = $scope.locations;
		// console.log(results);
		// functions have been describe process the data for display
		$scope.updatePagination();
		//console.log($scope.filteredItems);
	});


	var searchMatch = function (haystack, needle) {
        if (!needle) {
            return true;
        }
        return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
    };

    // init the filtered items
    $scope.filterSearch = function (onFilteredItems) {
    	var innerFilterSearch = function ( item ) {
    		if($scope.query == ""){ return true; }

    		if (searchMatch(item.name, $scope.query)){
                return true;
            }
            return false;
    	}

    	if(!onFilteredItems){
    		$scope.filteredItems = $filter('filter')($scope.locations, innerFilterSearch);
    	} else {
	        $scope.filteredItems = $filter('filter')($scope.filteredItems, innerFilterSearch);
	    }

	    if(!onFilteredItems){
	    	$scope.filterType(true);
	    	$scope.filterRange(true);
      		$scope.updatePagination();
      	}
    };

    $scope.updatePagination = function() {
		// take care of the sorting order
        if ($scope.sortingOrder !== '') {
            $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
        }
        $scope.currentPage = 0;
        // now group by pages
        $scope.groupToPages();
    };
    
    // calculate page in place
    $scope.groupToPages = function () {
        $scope.pagedItems = [];
        for (var i = 0; i < $scope.filteredItems.length; i++) {
            if (i % $scope.itemsPerPage === 0) {
                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [ $scope.filteredItems[i] ];
            } else {
                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.filteredItems[i]);
            }
        }
    };
    
    $scope.range = function (start, end) {
        var ret = [];
        if (!end) {
            end = start;
            start = 0;
        }
        for (var i = start; i < end; i++) {
            ret.push(i);
        }
        return ret;
    };
    
    $scope.prevPage = function () {
        if ($scope.currentPage > 0) {
            $scope.currentPage--;
        }
    };
    
    $scope.nextPage = function () {
        if ($scope.currentPage < $scope.pagedItems.length - 1) {
            $scope.currentPage++;
        }
    };
    
    $scope.setPage = function () {
        $scope.currentPage = this.n;
    };

	// init the filtered items
    $scope.filterType = function (onFilteredItems) {
    	var innerFilterType = function( item ){
    		// console.log( item );
        	if($scope.searchTypes.length == 0){ return true; }

			for(var i in $scope.searchTypes){
				if (item.types_array.indexOf($scope.searchTypes[i]) != -1) {
					return true;
				}
			}
			return false;
    	}

    	if(!onFilteredItems){
	        $scope.filteredItems = $filter('filter')($scope.locations, innerFilterType);
    	} else {
    		$scope.filteredItems = $filter('filter')($scope.filteredItems, innerFilterType);
    	}

    	if(!onFilteredItems){
    		$scope.filterRange(true);
    		$scope.filterSearch(true);
      		$scope.updatePagination();
      	}
    };



    $scope.toggleType = function(typesArray, type){
		if(typesArray.indexOf(type) != -1) {
			typesArray.splice(typesArray.indexOf(type), 1);
		} else {
			typesArray.push(type);
		}
		$scope.filterType();
	}



	$scope.getGeoLocation = function(scope) {

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
				});	
			}
		}

		var failedCallback = function () { console.log("Something went wrong during the ajax request."); }

		getLocationGoogleMaps(scope.geoLocation, successCallback, failedCallback);
	}

	$scope.rangeChange = function(scope){
		scope.rangenotset = (scope.curPlaceLat == undefined || scope.curPlaceLng == undefined) ? true : false;
		$scope.filterRange();
	}

	// init the filtered items
    $scope.filterRange = function (onFilteredItems) {
    	var innerFilterRange = function( item ){
        	if($scope.searchRange == 0 || $scope.curPlaceLat == undefined || $scope.curPlaceLng == undefined){ return true; }
            // console.log(item);

			var distance = Math.round(calcDistance($scope.curPlaceLat, $scope.curPlaceLng, item.latitude, item.longitude));
            item.distance = distance;
            item.distanceString = distance + ' km';

            $scope.distance = true;
			if(distance <= $scope.searchRange){
				return true;
			}
			return false;
    	}

    	if(!onFilteredItems){
	        $scope.filteredItems = $filter('filter')($scope.locations, innerFilterRange);
    	} else {
    		$scope.filteredItems = $filter('filter')($scope.filteredItems, innerFilterRange);
    	}

    	if(!onFilteredItems){
    		$scope.filterType(true);
    		$scope.filterSearch(true);
      		$scope.updatePagination();
      	}
    };

	$scope.submit = function(scope){
		scope.getGeoLocation( scope );
	}

    $scope.changeSortOrder = function(sort){

        console.log(sort);

        $scope.reverse = ($scope.sortingOrder == sort) ? !$scope.reverse : true;
        $scope.sortingOrder = sort;

        for(var i in $scope.sortArr){
            $scope.sortArr[i] = false;
        }

        var name = ($scope.reverse) ? 'Asc' : 'Desc';

        $scope.sortArr[sort+name] = true;

        $scope.updatePagination();


    }
 
};


locationApp.filter("createLink", function() {
	return function(id) {
		return window.BASE + "locations/" + id;
	}
});

locationApp.filter('formatAddress', function(){
    return function(formatted_address, postalcode, number, city){
        if(formatted_address != '') {
            return formatted_address;
        } else {
            return postalcode + ' ' + number + ' ' + city;
        }
    };
});

// locationApp.filter("typesToString", function() {
// 	return function(types) {
// 		//$scope.change++;
// 		var string = "";
// 		for(i in types){
// 			string += types[i] + ", ";
// 		}
// 		return string.substr(0, string.length - 2);
// 	}
// });

var locationDirective = locationApp.directive("locations", function() {
	return {
		restrict: "E",
		replace: true,
		templateUrl: window.BASE + "js/jstemplates/locations.html",
	}
});

var paginationDirective = locationApp.directive("pagination", function() {
	return {
		restrict: "E",
		replace: true,
		templateUrl: window.BASE + "js/jstemplates/pagination.html",
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

	