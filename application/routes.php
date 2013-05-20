<?php

//Home route
Route::get('/', 				array('as' => 'home', 			'uses' => 'home@index'));
Route::get('contact', 			array('as' => 'contact', 		'uses' => 'home@contact'));
Route::post('contact', 			array(							'uses' => 'home@contact'));

// user Resource
Route::get('login', 			array('as' => 'login', 			'uses' => 'users@login'							));		// form login
Route::get('logout', 			array('as' => 'logout', 		'uses' => 'users@logout', 	'before' => 'auth'	)); 	// logout
Route::get('register', 			array('as' => 'register',		'uses' => 'users@new'							));		// form register
Route::get('user/(:num)/edit', 	array('as' => 'edit_user', 		'uses' => 'users@edit', 	'before' => 'auth'	));		// form edit

Route::post('login', 			array('as' => 'login_post', 	'uses' => 'users@login', 	'before' => 'csrf'	));		// POST login
Route::post('register', 		array('as' => 'register_user', 	'uses' => 'users@create',	'before' => 'csrf'	));		// POST register
Route::put('user',		 		array('uses' => 'users@update', 'before' => 'csrf|auth'							)); 	// POST/PUT update
Route::delete('user/(:num)', 	array('uses' => 'users@destroy'													));

Route::get('profile',					array('as' => 'user_profile', 					'uses' => 'users@profile', 'before' => 'auth'));
Route::put('profile/update/data', 		array('as' => 'user_profile_updateData', 		'uses' => 'users@updateData', 'before' => 'csrf|auth'));
Route::put('profile/update/password', 	array('as' => 'user_profile_updatePassword', 	'uses' => 'users@updatePassword', 'before' => 'csrf|auth'));
Route::get('profile/(:num)',			array('as' => 'show_profile', 					'uses' => 'users@show'));
Route::get('profile/(:num)/comments',	array('as' => 'show_profile_comments', 			'uses' => 'users@showComments'));
Route::get('profile/(:num)/events',		array('as' => 'show_profile_events', 			'uses' => 'users@showEvents'));
Route::get('profile/(:num)/messages',	array('as' => 'show_profile_messages', 			'uses' => 'users@showMessages'));

Route::get('locations', 					array('as' => 'locations', 'uses' => 'locations@index'));
Route::get('locations/(:num)', 				array('as' => 'location', 'uses' => 'locations@show'));
Route::get('locations/(:num)/thumb/(:any)', 	array('as' => 'location_thumbAction', 'uses' => 'locations@thumbsAction'));
Route::post('locations/(:num)/comment', 		array('as' => 'location_post_comment', 'uses' => 'locations@comment', 'before' => 'csrf|auth'));
Route::post('locations/(:num)/feedback', 	array('as' => 'location_feedback', 'uses' => 'locations@feedback', 'before' => 'csrf|auth'));
Route::post('locations/feedback/comment', 	array('as' => 'location_comment_feedback', 'uses' => 'locations@feedback_comment', 'before' => 'csrf|auth'));
Route::get('locations/advice', 				array('as' => 'location_advice', 'uses' => 'locations@takeAdvice'));
Route::post('locations/advice', 				array('as' => 'location_advice_post', 'uses' => 'locations@takeAdvice', 'before' => 'csrf|auth'));

Route::get('news', 						array('as' => 'news', 				'uses' => 'news@index'));
Route::get('news/(:num)/edit'		, 	array('as' => 'news_edit', 			'uses' => 'news@edit'));
Route::put('news/update', 				array('as' => 'news_update', 		'uses' => 'news@update', 'before' => 'csrf|auth'));
Route::get('news/manage', 				array('as' => 'news_manage', 		'uses' => 'news@manage'));
Route::get('news/create', 				array('as' => 'news_create', 		'uses' => 'news@new'));
Route::post('news/create', 				array('as' => 'news_create_post', 	'uses' => 'news@create', 'before' => 'csrf|auth'));
Route::get('news/(:num)', 				array('as' => 'news_show', 			'uses' => 'news@show'));

Route::get('events', 					array('as' => 'events', 			'uses' => 'events@index'));
Route::get('events/create', 			array('as' => 'events_create', 		'uses' => 'events@new', 'before' => 'auth'));
Route::post('events/new', 				array('as' => 'events_create_post', 'uses' => 'events@create', 'before' => 'csrf|auth'));
Route::get('events/(:num)', 			array('as' => 'event_show', 		'uses' => 'events@show'));
Route::get('events/(:num)/sign_up', 	array('as' => 'event_signup',		'uses' => 'events@signup', 'before' => 'auth'));
Route::get('events/(:num)/sign_off', 	array('as' => 'event_signoff', 		'uses' => 'events@signoff', 'before' => 'auth'));

Route::get('admin', 					array('as' => 'dashboard', 			'uses' => 'administration@index'));



Route::get('testerdetest', function() {

	die("<h1>ALLEEN RUNNEN ALS ADRESSEN GEUPDATE MOETEN WORDEN!</h1>");

	$locations = Location::all();

	foreach($locations as $location)
	{
		// $address = $location -> number . ', ' . $location -> postalcode . ' ' .  $location -> city . ', The Netherlands';
		// $url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=false';
		// $location_data = json_decode(file_get_contents($url));

		// dd($location_data -> results[0] -> formatted_address);



		$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $location -> latitude . ',' . $location -> longitude . '&sensor=false';
		$location_data = json_decode(file_get_contents($url));

		// dd($location_data -> results[0] -> formatted_address);




		// $location -> postalcode = $location_data -> results[0] -> address_components[9] -> long_name;
		if($location_data -> status == "OK")
		{
			$location -> formatted_address = $location_data -> results[0] -> formatted_address;
			$location -> save();
		}
	}

});




/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});