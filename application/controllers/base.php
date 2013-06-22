<?php

class Base_Controller extends Controller {

	public function __construct(){

		// styles
		Asset::style('google-font', 'http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700|Monda:300,400,700|Oswald:400:700');
		Asset::add('bootstrap-min', 'css/bootstrap.min.css');
		Asset::add('bootstrap-responsive-min', 'css/bootstrap-responsive.min.css', 'bootstrap-min');
//		Asset::add('jquery-ui', 'css/cupertino/jquery-ui-1.10.3.custom.min.css');
		Asset::add('main', 'css/main.css');
		Asset::add('fontAwesome', 'css/font-awesome.min.css');

		// scripts in the head of the page
		Asset::container('header')->script('modernizr', 'js/vendor/modernizr-2.6.2-respond-1.1.0.min.js');

		// scripts on the bottom of the page
		Asset::container('footer')->script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
		Asset::container('footer')->script('twitter-widgets', 'http://platform.twitter.com/widgets.js');
		Asset::container('footer')->add('bootstrap-min-js', 'js/vendor/bootstrap.min.js');
//		Asset::container('footer')->add('jquery-ui-1.10.3-custom-min', 'js/vendor/jquery-ui-1.10.3.custom.min.js');
		Asset::container('footer')->add('main', 'js/main.js');
		
		
		$articles = Article::get_amount_published(3);		
		View::share('footer_articles', $articles);
		
		

		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
			'oauth_access_token' => "1539063871-pUKdqLNx5nidKJW6nmysuJUJaGCs0kpoWGgMfXu",
			'oauth_access_token_secret' => "NWUeFPC41GPEDaebcdaTLLjQbR2WQpwvYAqVTx3HG1g",
			'consumer_key' => "7aZxJZHI9QauQapTnR2aw",
			'consumer_secret' => "hqHb5vB2qczQFwTxZlmY7jtmHS34RHEk5K24sjiR5k"
		);

		$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$requestMethod = 'GET';
		$getfield = '?username=RdamOnbeperkt&count=3&include_rts=true';
		$twitter = new TwitterAPIExchange($settings);
		
		$twitter -> setGetfield($getfield);
        $twitter -> buildOauth($url, $requestMethod);
        $tweets = $twitter -> performRequest();
		
//		dd(json_decode($tweets));

		View::share('footer_tweets', json_decode($tweets));
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