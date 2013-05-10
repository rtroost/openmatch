<?php

class Events_Controller extends Base_Controller
{
	public $restful = true;

	public function __construct() {
		parent::__construct();
	}

	public function get_index() {

		$events_recommended = UserEvent::get_recommended(10);
		$events_recent = UserEvent::get_recent(10);
		$events_ending = UserEvent::get_ending(10);
		$events_nearfull = UserEvent::get_nearfull(10);


		return View::make('events.index')
			-> with('events_recommended', $events_recommended)
			-> with('events_recent', $events_recent)
			-> with('events_ending', $events_ending)
			-> with('events_nearfull', $events_nearfull);
	}

	public function get_show($event_id) {

		$event = UserEvent::with('user') -> with('signups') -> where('id', '=', $event_id) -> first();

		if(Auth::check())
			$signedUpState = EventSignup::where('user_id', '=', Auth::user() -> id) -> where('event_id', '=', $event -> id) -> first();
		else
			$signedUpState = null;

		return View::make('events.show')
		-> with('event', $event)
		-> with('signedUpState', $signedUpState);
	}

	public function get_new(){
		return View::make('events.new');
	}

	public function post_create(){

		$validation = UserEvent::validate(Input::all());

		if($validation -> fails()) {

			// dd(strtotime(Input::get('event_start') . ' ' . Input::get('event_start-hours') . ':' . Input::get('event_start-minutes')));
			// dd(DateTime::createFromFormat('l, d M, Y H:i', Input::get('event_start') . ' ' . Input::get('event_start-hours') . ':' . Input::get('event_start-minutes')));
			// dd(Input::get('event_start') . ' ' . Input::get('event_start-hours') . ':' . Input::get('event_start-minutes'));

			return Redirect::to_route('events_create')
				-> with_errors($validation)
				-> with_input();
		} else {

			$location = Input::get('location');

			$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($location) . '&sensor=false';
			$location_data = json_decode(file_get_contents($url));

			$event = UserEvent::create(array(
				'user_id' => Auth::user() -> id,
				'title' => Input::get('title'),
				'description' => Input::get('description'),
				'location' => Input::get('location'),
				'location_lat' => $location_data -> results[0] -> geometry -> location -> lat,
				'location_lng' => $location_data -> results[0] -> geometry -> location -> lng,
				'min_participants' => Input::get('participants-min'),
				'max_participants' => Input::get('participants-max'),
				'event_start_stamp' => DateTime::createFromFormat('l, d M, Y H:i', Input::get('event_start') . ' ' . Input::get('event_start-hours') . ':' . Input::get('event_start-minutes')) -> format(DateTime::ISO8601),
				'event_end_stamp' => DateTime::createFromFormat('l, d M, Y H:i', Input::get('event_end') . ' ' . Input::get('event_end-hours') . ':' . Input::get('event_end-minutes')) -> format(DateTime::ISO8601),
				'participation_end_stamp' => DateTime::createFromFormat('l, d M, Y H:i', Input::get('participation_end') . ' ' . Input::get('participation_end-hours') . ':' . Input::get('participation_end-minutes')) -> format(DateTime::ISO8601),
			));

			return Redirect::to_route('event_show', $event -> id)
				-> with('message', 'Je evenement is toegevoegd!');
		}

	}

	public function get_edit($index){

	}

	public function put_update($index){

	}

	public function delete_destroy($index){

	}

	public function get_signup($id){

		$event = UserEvent::with('signups') -> where('id', '=', $id) -> first();

		if(count($event -> signups) >= $event -> max_participants) {
			return Redirect::to_route('event_show', $id)
			-> with('message', 'Dit evenement zit al vol.');
		}

		$signup_data = EventSignup::create(array(
			'user_id' => Auth::user() -> id,
			'event_id' => $id,
		));

		$percentage_full = round(((count($event -> signups) + 1 / $event -> max_participants) * 100), 0);

		$event -> participants_percentage = $percentage_full;
		$event -> save();

		return Redirect::to_route('event_show', $id)
			-> with('message', 'Je bent nu aangemeld voor dit evenement!');
	}

	public function get_signoff($id){

		EventSignup::where('user_id', '=', Auth::user() -> id) -> where('event_id', '=', $id) -> delete();

		$event = UserEvent::with('signups') -> where('id', '=', $id) -> first();

		$percentage_full = round(((count($event -> signups) / $event -> max_participants) * 100), 0);
		$event -> participants_percentage = $percentage_full;
		$event -> save();

		return Redirect::to_route('event_show', $id)
			-> with('message', 'Je bent nu afgemeld van dit evenement.');
	}

}
