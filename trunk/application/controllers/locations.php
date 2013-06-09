<?php

class Locations_Controller extends Base_Controller {

	public $restful = true;

	public function __construct() {
		parent::__construct();

	}

	public function get_index(){

		if(Request::ajax()){
			$locations = Location::with('types')->get();

			if(Input::get('action') == 'geo'){
				
				$locations = locationLib::imageToLocations($locations);

				return Response::eloquent($locations);

			} else {
				foreach ($locations as $key => $value) {
					$newtypes = [];
					foreach ($value->types as $key2 => $value2) {
						$newtypes[] = $value2->naam;
					}
					$value->types_array = $newtypes;
				}
				return Response::eloquent($locations);
			}
		}

		//$locations = Location::with('types')->get();


		// foreach ($locations as $key => $value) {
		// 	foreach ($value->types as $key2 => $value2) {
		// 		//dd($value2->naam);
		// 		$newtypes[] = $value2->naam;
		// 	}
		// 	$value->types = $newtypes;
		// 	$value->relationships = null;
		// 	//dd($value->relationships);
		// }
		// dd($locations);
				//return Response::eloquent($locations);
			

		// hier moet eventueel nog een view komen
		Asset::container('footer')->add('angular', 'js/vendor/angular.min.js');
		Asset::container('footer')->add('angularResource', 'js/vendor/angular-resource.js');
		Asset::container('footer')->add('locationApp', 'js/location.app.js', array('angular', 'angularResource'));
		// Asset::container('footer')->add('location_filter', 'js/location_filter.js', 'jquery');
		// Asset::container('footer')->add('event_index', 'js/event.index.js', array('jquery', 'location_filter', 'handlebars'));

		return View::make('location.index');
	}

	public function get_show($index){

		Asset::container('footer')->add('rating_js', 'js/vendor/rating.js');
		Asset::container('footer')->add('locations', 'js/locations.js');
		Asset::container('footer')->add('maps_api', 'http://maps.google.com/maps/api/js?sensor=false');
		Asset::add('rating_css', 'css/rating.css');

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

	public function post_feedback() {

		$validation = LocationFeedback::validate(Input::all());

		$location = Location::find(Input::get('location_id'));

		if($validation -> fails()) {

			return Redirect::to_route('location', $location -> id)
				-> with_input()
				-> with_errors($validation);
		} else {

			LocationFeedback::create(array(
				'location_id' => $location -> id,
				'user_id' => Auth::user() -> id,
				'message' => Input::get('feedback-input')
			));

			return Redirect::to_route('location', $location -> id)
				-> with('message', 'Bedankt voor het geven van je feedback!');

		}

	}

	public function post_feedback_comment() {

		$validation = LocationCommentFeedback::validate(Input::all());

		// $location = Location::find(Input::get('location_id'));
		$comment = LocationComment::find(Input::get('comment_id'));

		if($validation -> fails()) {
			if(Request::ajax())
				return json_encode("false");

			return Redirect::to_route('location', $location -> id);
		} else {
			LocationCommentFeedback::create(array(
				'locationcomment_id' => Input::get('comment_id'),
				'user_id' => Auth::user() -> id,
				'message' => Input::get('message')
			));

			return json_encode("true");
		}
	}

	public function get_takeAdvice() {
		return View::make('location.advice');
	}

	public function post_takeAdvice() {

		$validation = LocationAdvice::validate(Input::all());

		if($validation->fails()) {

			return Redirect::to_route('location_advice')
				-> with_input()
				-> with_errors($validation);

		} else {

			LocationAdvice::create(array(
				'user_id' => Auth::user() -> id,
				'title' => Input::get('location-title'),
				'website' => Input::get('location-website'),
				'address' => Input::get('location-address'),
				'category' => Input::get('location-category'),
			));

			return Redirect::to_route('locations')
				-> with('message', 'Je inzending is voltooid en zal zo snel mogelijk door een bevoegde bekeken worden.');

		}
	}
}