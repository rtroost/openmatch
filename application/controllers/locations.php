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
					$newtypes = array();
					foreach ($value->types as $key2 => $value2) {
						$newtypes[] = $value2->naam;
					}
					$value->types_array = $newtypes;
				}

				return Response::eloquent($locations);

			} elseif(Input::get('action') == 'TOON') {
				
				$locations = Location::with('types') -> order_by(DB::raw('RAND()')) -> take(5) -> get();

				$locations = locationLib::imageToLocations($locations);

				return Response::eloquent($locations);

			} elseif(Input::get('action') == 'LOCATIE_DICHTBIJ') {

				$lat = Input::get('lat');
				$lng = Input::get('lng');
				$locations = Location::with('types')->order_by('id', 'desc')->get();

				foreach ($locations as $key => $value) {
					$value->distance = locationLib::calcDistance($lat, $lng, $value->latitude, $value->longitude);
				}

				locationLib::aasort($locations, "distance");

				$locations = locationLib::imageToLocations($locations);

				return Response::eloquent(array_slice($locations, 0, 5, true));
			} elseif(Input::get('action') == 'HOOGST_BEOORDEELD') {
				$locations = Location::with('types')->order_by('score', 'desc')->take(5)->get();

				$locations = locationLib::imageToLocations($locations);

				return Response::eloquent($locations);
			} elseif(Input::get('action') == 'AANBEVOLEN') {
				$locations = Location::with('types')->where('recommended', '=', '1')->order_by('id', 'desc')->take(5)->get();

				$locations = locationLib::imageToLocations($locations);

				return Response::eloquent($locations);
			} elseif(Input::get('action') == 'PARKINGPLACES') {
				$lat = Input::get('lat');
				$lng = Input::get('lng');

				$parkingplaces = Parkingplace::all();
				$newParking = array();
				foreach ($parkingplaces as $key => $value) {
					$value->distance = locationLib::calcDistance($lat, $lng, $value->latitude, $value->longitude);
					if($value->distance <= 1.0){
						$newParking[] = $value;
					}
				}
				return Response::eloquent($newParking);
			} else {
				$locations = Location::with('types')->get();
				$locations = locationLib::imageToLocations($locations);
				foreach ($locations as $key => $value) {
					$newtypes = array();
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
		Asset::container('footer')->add('rating_js', 'js/vendor/jquery.raty.min.js');
		Asset::container('footer')->add('getLocationGoogleMaps', 'js/googlemaps/getLocationGoogleMaps.js');

		return View::make('location.index');
	}

	public function get_show($index){

		if(Request::ajax()){

		}

		Asset::container('footer')->add('rating_js', 'js/vendor/jquery.raty.min.js');
		Asset::container('footer')->add('locations', 'js/locations.js');
		Asset::container('footer')->add('maps_api', 'http://maps.google.com/maps/api/js?sensor=false');
		Asset::container('footer')->add('getLocationGoogleMaps', 'js/googlemaps/getLocationGoogleMaps.js');
		Asset::container('footer')->add('maps', 'js/googlemaps/maps.js', array('googlemaps', 'jquery'));

		$location = Location::with('types') -> where('id', '=' , $index) -> first();
		$location = locationLib::imageToLocation($location);

		if(Auth::check()){
			$reactions = reactionLib::reactions($index, Auth::user()->id);
		}else{
			$reactions = reactionLib::reactions($index);
		}
		
		if(Auth::check())
			$locationRating = LocationRating::where('location_id', '=', $location -> id) -> where('user_id', '=', Auth::user() -> id) -> first();
		else
			$locationRating = null;
		
		$personal_rating_data = array();
		if($locationRating !== null) $personal_rating_data = json_decode($locationRating -> rating_dump);
		
		
		$averageRatings = json_decode($location -> score_indivavg);


		//  Parkeerplaatsen
		//  alle parkeerplaatsen pakken waar distance <= 1 km
		//  deze parkeerplaatsen meegeven aan view.

		
		//dd(Response::eloquent($newParking));

		// View:
		// parkeerplaatsen weergeven in de map
		// als route bescrhijving. pak parkeerplaats met kleinste distance en dan route daarheen.
		
	
		return View::make('location.show')
			-> with('location', $location)
			-> with('personal_rating_data', $personal_rating_data)
			-> with('reactions', $reactions)
			-> with('averageRatings', $averageRatings);
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

	public function get_takeFeedback($id) {
		$location = Location::find($id);

		return View::make('location.feedback')
			-> with('location', $location);
	}

	public function post_takeFeedback() {

		$location = Location::find(Input::get('location-id'));

		LocationFeedback::create(array(
			'location_id' => $location->id,
			'user_id' => Auth::user()->id,
			'message' => Input::get('location-message')
		));

		return Redirect::to_route('location', $location->id)
			-> with('message', 'Bedankt voor de feedback!');
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
				'telephone' => Input::get('location-telephone'),
				'category' => Input::get('location-category'),
			));

			return Redirect::to_route('locations')
				-> with('message', 'Je inzending is voltooid en zal zo snel mogelijk behandeld worden!');

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
		foreach($scores as $score) {
			if($score > 5 || $score < 1) Redirect::to_route('home');
			$score_avg += round($score);
		}
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

	public function post_setReaction() {
		$reactionOn = Input::get('reactionOn');
		$id = Input::get('id');
		$reaction = Input::get('reaction');
		$user = Auth::user();

		$theReaction = ReactionLib::postReaction($reactionOn, $id, $reaction, $user->id);

		if(is_int($theReaction)){
			return 0;
		}else{

			$firstname = $user->name;
			$insert = $user->prefix;
			$lastname = $user->surname;
			

			$insertion = $insert ? $insert.' ' : '';
			$fullname = $firstname.' '.$insertion.$lastname;

			return View::make('location/reaction')
			-> with('reaction', $theReaction)
			-> with('fullname', $fullname);
		}
	}

	public function post_updateReaction(){
		$reactionOn = Input::get('reactionOn');
		$id = Input::get('id');
		$reaction = Input::get('reaction');
		$user = Auth::user();
		$reactionId = Input::get('reactionId');

		$theReaction = ReactionLib::updateReaction($reactionOn, $id, $reaction, $user->id, $reactionId);

		if(is_int($theReaction)){
			return 0;
		}else{

			$firstname = $user->name;
			$insert = $user->prefix;
			$lastname = $user->surname;
			

			$insertion = $insert ? $insert.' ' : '';
			$fullname = $firstname.' '.$insertion.$lastname;

			return View::make('location/reaction')
			-> with('reaction', $theReaction)
			-> with('fullname', $fullname);
		}
	}

	public function post_deleteReaction(){
		$reactionOn = Input::get('reactionOn');
		$reactionId = Input::get('reactionId');

		$theReaction = ReactionLib::deleteReaction($reactionOn, $reactionId);

		if(is_int($theReaction)){
			return 0;
		}else{
			return 1;
		}
	}

	public function post_thumbReaction(){
		$reactionOn = Input::get('reactionOn');
		$reactionId = Input::get('reactionId');
		$type = Input::get('type');
		$user = Auth::user()->id;

		ReactionLib::thumbReaction($reactionOn, $reactionId, $type, $user);
	}
}