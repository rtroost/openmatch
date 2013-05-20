//WORKAROUND TOTDAT LARAVEL 4 ER IS
$("#filter_location-range").change( function() {
	$("#filter_location-range-value").html($(this).val() + ' km');
});
//ENDWORKAROUND

var locationApp = angular.module('locationApp', ['ngResource']);

var locationCtrl = function LocationCtrl($scope, $resource, $rootScope, $filter) {

	$scope.sortingOrder = "name";
    $scope.reverse = false;
    $scope.filteredItems = [];
    $scope.groupedItems = [];
    $scope.itemsPerPage = 25;
    $scope.pagedItems = [];
    $scope.currentPage = 0;


    // ---------------

	$rootScope.BASE = window.BASE;
	$scope.searchTypes = [];
	$scope.searchRange = 0;

	$scope.locationsGet = $resource(window.BASE + 'locations',
		{callback: 'JSON_CALLBACK'},
		{get: {method:'GET', isArray: true}}
	);
	$scope.locations = $scope.locationsGet.get(function(results){
		 // functions have been describe process the data for display
		$scope.filterSearch();
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

    		if (searchMatch(item.title, $scope.query)){
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


    // change sorting order
    $scope.sort_by = function(newSortingOrder) {
        if ($scope.sortingOrder == newSortingOrder)
            $scope.reverse = !$scope.reverse;

        $scope.sortingOrder = newSortingOrder;

        // icon setup
        $('th i').each(function(){
            // icon reset
            $(this).removeClass().addClass('icon-sort');
        });
        if ($scope.reverse)
            $('th.'+new_sorting_order+' i').removeClass().addClass('icon-chevron-up');
        else
            $('th.'+new_sorting_order+' i').removeClass().addClass('icon-chevron-down');
    };


	// init the filtered items
    $scope.filterType = function (onFilteredItems) {
    	var innerFilterType = function( item ){
        	if($scope.searchTypes.length == 0){ return true; }

			for(var i in $scope.searchTypes){
				if (item.types.indexOf($scope.searchTypes[i]) != -1) {
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
				});	
			}
		}

		var failedCallback = function () { console.log("Something went wrong during the ajax request."); }
	}

	$scope.rangeChange = function(scope){
		scope.rangenotset = (scope.curPlaceLat == undefined || scope.curPlaceLng == undefined) ? true : false;
		$scope.filterRange();
	}

	// init the filtered items
    $scope.filterRange = function (onFilteredItems) {
    	var innerFilterRange = function( item ){
        	if($scope.searchRange == 0 || $scope.curPlaceLat == undefined || $scope.curPlaceLng == undefined){ return true; }

			var distance = Math.round(calcDistance($scope.curPlaceLat, $scope.curPlaceLng, item.lat, item.lng));
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

};


locationApp.filter("createLink", function() {
	return function(id) {
		return window.BASE + "locations/" + id;
	}
});

locationApp.filter("typesToString", function() {
	return function(types) {
		//$scope.change++;
		var string = "";
		for(i in types){
			string += types[i] + ", ";
		}
		return string.substr(0, string.length - 2);
	}
});

// locationApp.filter("filterTypes", function() {
// 	return function(items, searchTypes, scope) {

// 		if(searchTypes.length == 0){ return items; }
// 		scope.change++;
// 		var arrayToReturn = [];
// 		for (var i=0; i < items.length; i++){
// 			for(var j in searchTypes){
// 				if (items[i].types.indexOf(searchTypes[j]) != -1) {
// 					arrayToReturn.push(items[i]);
// 				}
// 			}
			
// 		}
// 		//scope.updatePaginate();
// 		return arrayToReturn;
// 	}
// });

// locationApp.filter("filterRange", function() {
// 	return function(items, obj) {
// 		//$scope.change++;
// 		if(obj.searchRange == 0 || obj.lat == undefined || obj.lng == undefined){ return items; }

// 		var arrayToReturn = [];  
// 		for (var i=0; i < items.length; i++){
// 			var distance = Math.round(calcDistance(obj.lat, obj.lng, items[i].lat, items[i].lng));
// 			if(distance <= obj.searchRange){
// 				arrayToReturn.push(items[i]);
// 			}
// 		}
		
// 		return arrayToReturn;
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

	