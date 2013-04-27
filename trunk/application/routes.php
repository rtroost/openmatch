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

Route::get('profile',			array('as' => 'user_profile', 					'uses' => 'users@profile', 'before' => 'auth'));
Route::put('profile/data', 		array('as' => 'user_profile_updateData', 		'uses' => 'users@updateData', 'before' => 'auth'));
Route::put('profile/password', 	array('as' => 'user_profile_updatePassword', 	'uses' => 'users@updatePassword', 'before' => 'auth'));
Route::get('profile/(:num)',	array('as' => 'show_profile', 					'uses' => 'users@show'));
Route::get('profile/(:num)/comments',	array('as' => 'show_profile', 			'uses' => 'users@showComments'));
Route::get('profile/(:num)/events',		array('as' => 'show_profile', 			'uses' => 'users@showEvents'));
Route::get('profile/(:num)/messages',	array('as' => 'show_profile', 			'uses' => 'users@showMessages'));


Route::get('locations', 		array('as' => 'locations', 'uses' => 'locations@index'));
Route::get('location/(:num)', 	array('as' => 'location', 'uses' => 'locations@show'));






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