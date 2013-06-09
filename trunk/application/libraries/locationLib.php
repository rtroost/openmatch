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
			case 'kindervermaak':		$img = 'iconKidsEntertainment'; break;
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


}