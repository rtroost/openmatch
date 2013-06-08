<?php

class Home_Controller extends Base_Controller {

	public $restful = true;

	public function get_index(){

		if(Request::ajax()){
			if(Input::get('action') == 'TOON'){
				$locations = Location::with('types')->order_by('id', 'desc')->take(5)->get();

				foreach ($locations as $key => $value) {
					switch ($value->types[0]->naam) {
						case 'bibliotheken':		$value->img = 'iconLibrary'; break;
						case 'bioscopen':			$value->img  = 'iconCinema'; break;
						case 'campings':			$value->img  = 'iconCamping'; break;
						case 'sportgelegenheden':	$value->img  = 'iconSports'; break;
						case 'kinderboerderijen':	$value->img  = 'iconKidsFarm'; break;
						case 'kindervermaak':		$value->img  = 'iconKidsEntertainment'; break;
						case 'theaters':			$value->img  = 'iconTheater'; break;
						case 'recreatieterreinen':	$value->img  = 'iconRecreation'; break;
						case 'zwembaden':			$value->img  = 'iconSwimming'; break;
						case 'musea':				$value->img  = 'iconMuseum'; break;
						case 'restaurants':			$value->img  = 'iconRestaurant'; break;
						case 'dierentuin':			$value->img  = 'iconZoo'; break;
						case 'attracties':			$value->img  = 'iconThemePark'; break;
						case 'speeltuinen':			$value->img  = 'iconPlayground'; break;
						default:					$value->img  = 'automotive'; break;
					}
				}

				return Response::eloquent($locations);

			} elseif(Input::get('action') == 'LOCATIE_DICHTBIJ') {
				$locations = Location::with('types')->order_by('id', 'desc')->take(5)->get();

				foreach ($locations as $key => $value) {
					switch ($value->types[0]->naam) {
						case 'bibliotheken':		$value->img = 'iconLibrary'; break;
						case 'bioscopen':			$value->img  = 'iconCinema'; break;
						case 'campings':			$value->img  = 'iconCamping'; break;
						case 'sportgelegenheden':	$value->img  = 'iconSports'; break;
						case 'kinderboerderijen':	$value->img  = 'iconKidsFarm'; break;
						case 'kindervermaak':		$value->img  = 'iconKidsEntertainment'; break;
						case 'theaters':			$value->img  = 'iconTheater'; break;
						case 'recreatieterreinen':	$value->img  = 'iconRecreation'; break;
						case 'zwembaden':			$value->img  = 'iconSwimming'; break;
						case 'musea':				$value->img  = 'iconMuseum'; break;
						case 'restaurants':			$value->img  = 'iconRestaurant'; break;
						case 'dierentuin':			$value->img  = 'iconZoo'; break;
						case 'attracties':			$value->img  = 'iconThemePark'; break;
						case 'speeltuinen':			$value->img  = 'iconPlayground'; break;
						default:					$value->img  = 'automotive'; break;
					}
				}

				return Response::eloquent($locations);
			} elseif(Input::get('action') == 'HOOGST_BEOORDEELD') {
				$locations = Location::with('types')->order_by('id', 'desc')->take(5)->get();

				foreach ($locations as $key => $value) {
					switch ($value->types[0]->naam) {
						case 'bibliotheken':		$value->img = 'iconLibrary'; break;
						case 'bioscopen':			$value->img  = 'iconCinema'; break;
						case 'campings':			$value->img  = 'iconCamping'; break;
						case 'sportgelegenheden':	$value->img  = 'iconSports'; break;
						case 'kinderboerderijen':	$value->img  = 'iconKidsFarm'; break;
						case 'kindervermaak':		$value->img  = 'iconKidsEntertainment'; break;
						case 'theaters':			$value->img  = 'iconTheater'; break;
						case 'recreatieterreinen':	$value->img  = 'iconRecreation'; break;
						case 'zwembaden':			$value->img  = 'iconSwimming'; break;
						case 'musea':				$value->img  = 'iconMuseum'; break;
						case 'restaurants':			$value->img  = 'iconRestaurant'; break;
						case 'dierentuin':			$value->img  = 'iconZoo'; break;
						case 'attracties':			$value->img  = 'iconThemePark'; break;
						case 'speeltuinen':			$value->img  = 'iconPlayground'; break;
						default:					$value->img  = 'automotive'; break;
					}
				}

				return Response::eloquent($locations);
			} elseif(Input::get('action') == 'AANBEVOLEN') {
				$locations = Location::with('types')->order_by('id', 'desc')->take(5)->get();

				foreach ($locations as $key => $value) {
					switch ($value->types[0]->naam) {
						case 'bibliotheken':		$value->img = 'iconLibrary'; break;
						case 'bioscopen':			$value->img  = 'iconCinema'; break;
						case 'campings':			$value->img  = 'iconCamping'; break;
						case 'sportgelegenheden':	$value->img  = 'iconSports'; break;
						case 'kinderboerderijen':	$value->img  = 'iconKidsFarm'; break;
						case 'kindervermaak':		$value->img  = 'iconKidsEntertainment'; break;
						case 'theaters':			$value->img  = 'iconTheater'; break;
						case 'recreatieterreinen':	$value->img  = 'iconRecreation'; break;
						case 'zwembaden':			$value->img  = 'iconSwimming'; break;
						case 'musea':				$value->img  = 'iconMuseum'; break;
						case 'restaurants':			$value->img  = 'iconRestaurant'; break;
						case 'dierentuin':			$value->img  = 'iconZoo'; break;
						case 'attracties':			$value->img  = 'iconThemePark'; break;
						case 'speeltuinen':			$value->img  = 'iconPlayground'; break;
						default:					$value->img  = 'automotive'; break;
					}
				}

				return Response::eloquent($locations);
			}
		}



		Asset::container('footer')->script('googlemaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAgla0GXZ3SEtW2NT1eAzdYRqYSX0J2-YA&sensor=true');
		Asset::container('footer')->add('maps', 'js/googlemaps/maps.js', array('googlemaps', 'jquery'));
		Asset::container('footer')->add('maps_locations', 'js/googlemaps/maps_locations.js', array('googlemaps', 'jquery'));
		Asset::container('footer')->add('location_filter', 'js/location_filter.js', 'jquery');
		Asset::container('footer')->add('home_index', 'js/home.index.js', array('googlemaps', 'jquery', 'maps', 'maps_locations'));

		$articles = Article::get_amount_published(5);

		$popular_articles = LocationThumb::get_popular(5);

		Asset::container('footer')->add('angular', 'js/vendor/angular.min.js');
		Asset::container('footer')->add('angularResource', 'js/vendor/angular-resource.js');
		Asset::container('footer')->add('indexApp', 'js/index.app.js', array('angular', 'angularResource'));

		return View::make('home.index')
			-> with('articles', $articles)
			-> with('popular_articles', $popular_articles);
	}

	public function get_contact(){
		return View::make('home.contact');
	}

	public function post_contact() {

		$rules = array(
			'fullname' => 'required|alpha_num|between:4,60',
			'email' => 'required|email',
			'message' => 'required|between:50,1000'
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
				$message -> to('someone@gmail.com');
				$message -> from('no-reply@openmatch.nl', 'OpenMatch Contact Form');

				$message -> subject('OpenMatch Form: ' . date("Y-m-d H:i:s"));
				$message -> body(
					'Name: ' . Input::get('fullname') . '<br />' .
					'E-Mail' . Input::get('email') . '<br />' .
					'Message' . '<br />' . Input::get('message'));

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