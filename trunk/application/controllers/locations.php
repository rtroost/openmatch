<?php

class Locations_Controller extends Base_Controller {

	public $restful = true;

	public function __construct() {
		parent::__construct();

	}

	public function get_index(){

		if(Request::ajax()){
			if(Input::get('action') == 'GEO') {
				$locations = Location::with('types')->get();
				$locations = locationLib::imageToLocations($locations);
				foreach ($locations as $key => $value) {
					$newtypes = [];
					foreach ($value->types as $key2 => $value2) {
						$newtypes[] = $value2->naam;
					}
					$value->types_array = $newtypes;
				}

				return Response::eloquent($locations);

			} elseif(Input::get('action') == 'TOON') {
				$locations = Location::with('types')->order_by('id', 'desc')->take(5)->get();

				$locations = locationLib::imageToLocations($locations);

				return Response::eloquent($locations);

			} elseif(Input::get('action') == 'LOCATIE_DICHTBIJ') {
				$locations = Location::with('types')->order_by('id', 'desc')->take(5)->get();

				$locations = locationLib::imageToLocations($locations);

				return Response::eloquent($locations);
			} elseif(Input::get('action') == 'HOOGST_BEOORDEELD') {
				$locations = Location::with('types')->order_by('id', 'desc')->take(5)->get();

				$locations = locationLib::imageToLocations($locations);

				return Response::eloquent($locations);
			} elseif(Input::get('action') == 'AANBEVOLEN') {
				$locations = Location::with('types')->order_by('id', 'desc')->take(5)->get();

				$locations = locationLib::imageToLocations($locations);

				return Response::eloquent($locations);
			} else {
				$locations = Location::with('types')->get();
				$locations = locationLib::imageToLocations($locations);
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
	

		// hier moet eventueel nog een view komen
		Asset::container('footer')->add('angular', 'js/vendor/angular.min.js');
		Asset::container('footer')->add('angularResource', 'js/vendor/angular-resource.js');
		Asset::container('footer')->add('locationApp', 'js/location.app.js', array('angular', 'angularResource'));
		Asset::container('footer')->add('getLocationGoogleMaps', 'js/googlemaps/getLocationGoogleMaps.js');

		return View::make('location.index');
	}

	public function get_show($index){

		Asset::container('footer')->add('rating_js', 'js/vendor/jquery.raty.min.js');
		Asset::container('footer')->add('locations', 'js/locations.js');
		Asset::container('footer')->add('maps_api', 'http://maps.google.com/maps/api/js?sensor=false');
		Asset::container('footer')->add('getLocationGoogleMaps', 'js/googlemaps/getLocationGoogleMaps.js');

		$location = Location::with('types') -> where('id', '=' , $index) -> first();
		$location = locationLib::imageToLocation($location);
		
		if(Auth::check())
			$locationRating = LocationRating::where('location_id', '=', $location -> id) -> where('user_id', '=', Auth::user() -> id) -> first();
		else
			$locationRating = null;
		
		$personal_rating_data = array();
		if($locationRating !== null) $personal_rating_data = json_decode($locationRating -> rating_dump);
		
		
		Bundle::start('laravel-disqus');
    	$disqus = new Disqus('rotterdamonbeperkt');
		
		return View::make('location.show')
			-> with('location', $location)
			-> with('personal_rating_data', $personal_rating_data)
			-> with('disqus', $disqus);
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

//	public function post_comment() {
//
//		$location_id = Input::get('location_id');
//
//		$validation = LocationComment::Validate(Input::all());
//
//		if($validation -> fails()) {
//
//			return Redirect::to_route('location', $location_id)
//				-> with_input()
//				-> with_errors($validation)
//				-> with('message', 'Uw bericht is niet geplaatst.');
//		} else {
//			
//			$reply_id = (Input::get('reply_id')) ? Input::get('reply_id') : null;
//
//			$comment = LocationComment::create(array(
//				'user_id' => Auth::user() -> id,
//				'location_id' => $location_id,
//				'reply_id' => $reply_id,
//				'body' => Input::get('message_body'),				
//			));
//
//			return Redirect::to_route('location', $location_id)
//				-> with('message', 'Uw bericht is geplaatst.')
//				-> with('new_comment', $comment);
//		}
//
//	}

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

//	public function post_feedback_comment() {
//
//		$validation = LocationCommentFeedback::validate(Input::all());
//
//		// $location = Location::find(Input::get('location_id'));
//		$comment = LocationComment::find(Input::get('comment_id'));
//
//		if($validation -> fails()) {
//			if(Request::ajax())
//				return json_encode("false");
//
//			return Redirect::to_route('location', $location -> id);
//		} else {
//			LocationCommentFeedback::create(array(
//				'locationcomment_id' => Input::get('comment_id'),
//				'user_id' => Auth::user() -> id,
//				'message' => Input::get('message')
//			));
//
//			return json_encode("true");
//		}
//	}

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
	
	public function post_setRating() {
		
		$user = Auth::user();
		$location = Location::find(Input::get('location_id'));
		
		// Couldn't find the location
		if($location == null) return Redirect::to_route('home');
		
		// Get the scores from input
		$scores = Input::get('scores');
		
		// Clear old scores first
		LocationRating::where('user_id', '=', $user -> id) -> where('location_id', '=', $location -> id) -> delete();
		
		// Calculate avarage score
		$score_avg = 0;
		foreach($scores as $score) $score_avg += $score;
		$score_avg /= sizeof($scores);
				
		$obj = LocationRating::create(array(
			'location_id' => $location -> id,
			'user_id' => $user -> id,
			'rating_dump' => json_encode($scores),
			'rating_avg' => $score_avg,
		));	
		
		// Calculate the average
		$location -> recalculateScore();
		
		
		return Redirect::to_route('location', $location -> id)
			-> with('message', 'Bedankt voor uw beoordeling!');
	}
}