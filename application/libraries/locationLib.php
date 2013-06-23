<?php

class LocationLib {

	/*
		Requires: "Locations with types" from Eloquent
		Output:   Locations Eloquent objects with extra attribute "img"
	*/
	public static function imageToLocations($locations){

		foreach ($locations as $key => $value) {
			$value->img = LocationLib::typeToImg($value->types);
		}
		return $locations;
	}

	public static function imageToLocation($location){
		$location->img = LocationLib::typeToImg($location->types);
		return $location;
	}

	private static function typeToImg($types){
		switch ($types[0]->naam) {
			case 'bibliotheken':		$img = 'iconLibrary'; break;
			case 'bioscopen':			$img = 'iconCinema'; break;
			case 'campings':			$img = 'iconCamping'; break;
			case 'sportgelegenheden':	$img = (isset($types[1]) && $types[1]->naam == "zwembaden" ? 'iconSwimming' : 'iconSports'); break;
			case 'kinderboerderijen':	$img = 'iconKidsFarm'; break;
			case 'kindervermaak':		$img = LocationLib::checkKindervermaak($types); break;
			case 'theaters':			$img = 'iconTheater'; break;
			case 'recreatieterreinen':	$img = 'iconRecreation'; break;
			case 'zwembaden':			$img = 'iconSwimming'; break;
			case 'musea':				$img = 'iconMuseum'; break;
			case 'restaurants':			$img = 'iconRestaurant'; break;
			case 'dierentuin':			$img = 'iconZoo'; break;
			case 'attracties':			$img = 'iconThemePark'; break;
			case 'speeltuinen':			$img = 'iconPlayground'; break;
			default:					$img = 'automotive'; break;
		}
		return $img;
	}
// $img = (isset($types[1]) ? ($types[1]->naam == "dierentuin") ? 'iconZoo' : 'iconPlayground') : 'iconKidsEntertainment'); break;
	private static function checkKindervermaak ($types){
		if(isset($types[1])){
			switch ($types[1]->naam) {
				case "dierentuin": 	return 'iconZoo';
				case "speeltuinen": return 'iconPlayground';
				case "zwembaden": 	return 'iconSwimming';
				default: 			return 'iconKidsEntertainment';
			}
		} else {
			return 'iconKidsEntertainment';
		}
	}

	public static function calcDistance($lat1, $lng1, $lat2, $lng2){
		$R = 6371; // Radius of the earth in km
		$dLat = LocationLib::deg2rad($lat2-$lat1);  // deg2rad below
		$dLon = LocationLib::deg2rad($lng2-$lng1);
		$a = sin($dLat/2) * sin($dLat/2) + 
			cos(LocationLib::deg2rad($lat1)) * cos(LocationLib::deg2rad($lat2)) * 
			sin($dLon/2) * sin($dLon/2)
		; 
		$c = 2 * atan2(sqrt($a), sqrt(1-$a)); 
		$d = $R * $c; // Distance in km

		return $d;
	}

	private static function deg2rad($deg){
		return $deg * (pi()/180);
	}

	public static function aasort (&$array, $key) {
		$sorter=array();
		$ret=array();
		reset($array);
		foreach ($array as $ii => $va) {
			$sorter[$ii]=$va->$key;
		}
		asort($sorter);
		foreach ($sorter as $ii => $va) {
			$ret[$ii]=$array[$ii];
		}
		$array=$ret;
	}
}