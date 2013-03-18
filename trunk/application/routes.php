<?php

Route::get('/', array('as' => 'index', 'uses' => 'home@index'));

// user Resource
Route::get('login', array('as' => 'login', 'uses' => 'users@login')); 									// form login
Route::post('login', array('as' => 'login_post', 'uses' => 'users@login')); 							// POST login
Route::get('logout', array('as' => 'logout', 'before' => 'authuser', 'uses' => 'users@logout')); 		// logout

Route::get('users/(:num)', array('as' => 'user', 'uses' => 'users@show')); 								// eventueel profile pagina ~
Route::get('users/new', array('as' => 'new_user', 'uses' => 'users@new')); 								// form register
Route::get('users/edit', array('as' => 'edit_user', 'before' => 'authuser', 'uses' => 'users@edit')); 	// form edit
Route::post('users', 'users@create'); 																	// POST register
Route::put('users', array('before' => 'authuser', 'uses' => 'users@update')); 							// POST/PUT update
Route::delete('users/(:num)', 'users@destroy'); 														// niet gebruikt ~


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

Route::filter('authuser', function()
{
	if (Auth::guest()) return Redirect::to('login');
});