<?php

class Base_Controller extends Controller {

	public function __construct(){

		// styles
		Asset::style('google-font', 'http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,700|Monda:400,700');
		Asset::add('bootstrap-min', 'css/bootstrap.min.css');
		Asset::add('bootstrap-responsive-min', 'css/bootstrap-responsive.min.css', 'bootstrap-min');
		Asset::add('main', 'css/main.css', array('bootstrap-min', 'bootstrap-min'));

		// scripts in the head of the page
		Asset::container('header')->script('modernizr', 'js/vendor/modernizr-2.6.2-respond-1.1.0.min.js');

		// scripts on the bottom of the page
		Asset::container('footer')->script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
		Asset::container('footer')->add('bootstrap-min-js', 'js/vendor/bootstrap.min.js');
		Asset::container('footer')->add('main', 'js/main.js');
	}

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}