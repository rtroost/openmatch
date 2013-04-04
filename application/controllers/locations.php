<?php

class Locations_Controller extends Base_Controller {

	public $restful = true;

	public function get_index(){
		$locations = Location::with('types')->get();

		if(Request::ajax()){
			foreach ($locations as $key => $value) {
				$temp['location_id'] = $value->id;
				$temp['lat'] = $value->latitude;
				$temp['lng'] = $value->longitude;
				$temp['title'] = $value->name;
				$temp['website'] = $value->website;
				switch ($value->types[0]->naam) {
					case 'bibliotheken':		$temp['img'] = 'education'; break;
					case 'bioscopen':			$temp['img'] = 'company'; break;
					case 'campings':			$temp['img'] = 'sports'; break;
					case 'sportgelegenheden':	$temp['img'] = 'sports'; break;
					case 'kinderboerderijen':	$temp['img'] = 'sports'; break;
					case 'kindervermaak':		$temp['img'] = 'sports'; break;
					case 'theaters':			$temp['img'] = 'company'; break;
					case 'recreatieterreinen':	$temp['img'] = 'automotive'; break;
					case 'zwembaden':			$temp['img'] = 'sports'; break;
					case 'musea':				$temp['img'] = 'company'; break;
					case 'restaurants':			$temp['img'] = 'food'; break;
					case 'dierentuin':			$temp['img'] = 'sports'; break;
					case 'attracties':			$temp['img'] = 'company'; break;
					case 'speeltuinen':			$temp['img'] = 'sports'; break;
					default:					$temp['img'] = 'automotive'; break;
				}
				$jsonLocs[] = $temp;
			}
			return json_encode($jsonLocs);
		}

		// hier moet eventueel nog een view komen
		dd($locations);
	}

	public function post_create(){
		
	}

	public function get_show($index){
		
	}

	public function get_edit($index){
		
	}

	public function get_new(){
		
	}

	public function put_update($index){

	}

	public function detele_destroy($index){
	
	}
}