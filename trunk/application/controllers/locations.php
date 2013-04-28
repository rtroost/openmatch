<?php

class Locations_Controller extends Base_Controller {

	public $restful = true;

	public function __construct() {
		parent::__construct();
		Asset::container('footer')->add('maps_api', 'http://maps.google.com/maps/api/js?sensor=false');
		Asset::container('footer')->add('locations', 'js/locations.js');
	}

	public function get_index(){

		if(Request::ajax()){
			$locations = Location::with('types')->get();

			if(Input::get('action') == 'geo'){
				foreach ($locations as $key => $value) {
					$temp['location_id'] = $value->id;
					$temp['lat'] = $value->latitude;
					$temp['lng'] = $value->longitude;
					$temp['title'] = $value->name;
					$temp['website'] = $value->website;
					switch ($value->types[0]->naam) {
						case 'bibliotheken':		$temp['img'] = 'education'; break;
						case 'bioscopen':			$temp['img'] = 'automotive'; break;
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
					$temp2 = null;
					foreach ($value->types as $key2 => $value2) {
						$temp2[] = $value2->naam;
					}
					$temp['types'] = $temp2;
					$jsonLocs[] = $temp;
				}
				return json_encode($jsonLocs);
			} else {
				foreach ($locations as $key => $value) {
					$temp['location_id'] = $value->id;

					$temp['title'] = $value->name;
					$temp['website'] = $value->website;
					$temp['link'] = URL::to_route('location', $value->id);

					$temp2 = null;
					foreach ($value->types as $key2 => $value2) {
						$temp2[] = $value2->naam;
					}
					$temp['types'] = $temp2;
					$jsonLocs[] = $temp;
				}
				return json_encode($jsonLocs);
			}
		}

		// hier moet eventueel nog een view komen
		Asset::container('footer')->add('handlebars', 'js/vendor/handlebars.js');
		Asset::container('footer')->add('location_filter', 'js/location_filter.js', 'jquery');
		Asset::container('footer')->add('event_index', 'js/event.index.js', array('jquery', 'location_filter', 'handlebars'));

		return View::make('location.index');
	}

	public function get_show($index){

		$location = Location::with('types') -> with('comments') -> where('id', '=' , $index) -> first();

		if(Auth::check())
			$thumbState = LocationThumb::where('user_id', '=', Auth::user() -> id) -> where('location_id', '=', $location -> id) -> first();
		else
			$thumbState = null;

		// dd($thumbState);
		return View::make('location.show')
		-> with('location', $location)
		-> with('thumbState', $thumbState);
	}

	public function get_new(){

	}

	public function post_create(){

	}

	public function get_edit($index){

	}

	public function put_update($index){

	}

	public function delete_destroy($index){

	}

	public function post_comment() {

		$location_id = Input::get('location_id');

		$validation = LocationComment::Validate(Input::all());

		if($validation -> fails()) {

			return Redirect::to_route('location', $location_id)
				-> with_input()
				-> with_errors($validation)
				-> with('message', 'Uw bericht is niet geplaatst.');
		} else {

			$comment = LocationComment::create(array(
				'user_id' => Auth::user() -> id,
				'location_id' => $location_id,
				'body' => Input::get('message_body')
			));

			return Redirect::to_route('location', $location_id)
				-> with('message', 'Uw bericht is niet geplaatst.')
				-> with('new_comment', $comment);
		}

	}

	public function get_thumbsAction($location_id, $direction) {

		$location = Location::find($location_id);

		if($direction == 'up')
			$action = true;
		elseif($direction == 'down')
			$action = false;
		else
			return Redirect::to_route('location', $location -> id);

		$user = Auth::user();

		$user -> locationThumbs() -> where('location_id', '=', $location -> id) -> delete();

		LocationThumb::create(array(
			'location_id' => $location_id,
			'user_id' => $user -> id,
			'positive' => $action
		));

		return Redirect::to_route('location', $location_id);
	}
}