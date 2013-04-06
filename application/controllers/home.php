<?php

class Home_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function action_index(){

		Asset::container('footer')->script('googlemaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAgla0GXZ3SEtW2NT1eAzdYRqYSX0J2-YA&sensor=true');
		Asset::container('footer')->add('maps', 'js/googlemaps/maps.js', array('googlemaps', 'jquery'));
		Asset::container('footer')->add('maps_locations', 'js/googlemaps/maps_locations.js', array('googlemaps', 'jquery'));
		Asset::container('footer')->add('location_filter', 'js/location_filter.js', 'jquery');
		Asset::container('footer')->add('home_index', 'js/home.index.js', array('googlemaps', 'jquery', 'maps', 'maps_locations'));

		return View::make('home.index');
	}

	public function action_contact(){
		return View::make('home.contact');
	}

}