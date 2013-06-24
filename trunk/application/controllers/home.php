<?php

class Home_Controller extends Base_Controller {

	public $restful = true;

	public function get_index(){

		Asset::container('footer')->script('googlemaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAgla0GXZ3SEtW2NT1eAzdYRqYSX0J2-YA&sensor=true');
		Asset::container('footer')->add('maps', 'js/googlemaps/maps.js', array('googlemaps', 'jquery'));
		Asset::container('footer')->add('maps_locations', 'js/googlemaps/maps_locations.js', array('googlemaps', 'jquery'));
		Asset::container('footer')->add('location_filter', 'js/location_filter.js', 'jquery');
		Asset::container('footer')->add('home_index', 'js/home.index.js', array('googlemaps', 'jquery', 'maps', 'maps_locations'));
		Asset::container('footer')->add('rating_js', 'js/vendor/jquery.raty.min.js');

		Asset::container('footer')->add('angular', 'js/vendor/angular.min.js');
		Asset::container('footer')->add('angularResource', 'js/vendor/angular-resource.js');
		Asset::container('footer')->add('indexApp', 'js/index.app.js', array('angular', 'angularResource'));
		Asset::container('footer')->add('getLocationGoogleMaps', 'js/googlemaps/getLocationGoogleMaps.js');

		return View::make('home.index');
	}

	public function get_contact(){
		return View::make('home.contact');
	}

	public function post_contact() {

		$rules = array(
			'fullname' => 'required|match:/^([a-z\x20])+$/i|between:4,60',
			'email' => 'required|email',
			'message' => 'required|between:10,1000'
		);

		$validation = Validator::make(Input::all(), $rules);

		if($validation -> fails()) {
			return Redirect::to('contact')
				-> with('message', 'Je hebt sommige onderdelen niet correct ingevuld.')
				-> with_input()
				-> with_errors($validation);
		} else {

			Message::send(function($message)
			{
				$message -> to('info@rotterdamonbeperkt.nl');
				$message -> from('no-reply@rotterdamonbeperkt.nl', 'Rotterdam Onbeperkt');

				$message -> subject('Rotterdam Onbeperkt: ' . date("Y-m-d H:i:s"));
				$message -> body(
					"<b>Naam:</b> ".Input::get('fullname')."<br>
					<b>E-mail:</b> ".Input::get('email')."
					<p>
						<b>Bericht</b><br>
						".Input::get('message')."
					</p>
					<p>
						<i>Dit bericht is verzonden vanaf de website van Rotterdam Onbeperkt.</i>
					</p>"
				);

				$message -> html(true);
			});

			if(Message::was_sent()) {
				return Redirect::to('contact')
				-> with('message', 'Formulier verstuurd. Verwacht binnen 5 werkdagen antwoord.');
			} else {
				return Redirect::to('contact')
				-> with('message', 'Er ging iets mis bij het versturen van het bericht.');
			}
		}



	}

}