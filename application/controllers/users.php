<?php

class Users_Controller extends Base_Controller {

	public $restful = true;

	public function get_login(){
		return View::make('user.login');
	}

	public function post_login(){

		$credentials = array(
			'username' => Input::get('email'),
			'password' => Input::get('password')
		);

		if(Auth::attempt($credentials)) {
			return Redirect::to_route('home')
			-> with('message', 'You are now logged in!');
		} else {
			return Redirect::to_route('login')
			-> with('message', 'Your username/password combination was incorrect')
			-> with_input();
		}
	}

	public function get_new(){
		return View::make('user.new');
	}

	public function post_create() {

		$validation = User::validate(Input::all());

		if($validation->fails()) {
			return Redirect::to_route('register')
				-> with_errors($validation)
				-> with_input();
		} else {
			User::create(array(
				'name' => Input::get('name'),
				'surname' => Input::get('surname'),
				'prefix' => Input::get('prefix'),
				'email' => Input::get('email'),
				'password' => Hash::make(Input::get('password')),
				'address' => Input::get('address'),
				'zipcode' => Input::get('zipcode'),
				'city' => Input::get('city'),
				'country' => Input::get('country')
			));

			$user = User::where_email(Input::get('email')) -> first();
			Auth::login($user);

			return Redirect::to_route('home')
				->with('message', 'Thanks for registering. You are now logged in.');
		}
	}

	public function get_show($user_id){
		$user = User::find($user_id);

		return View::make('user.show', array('user' => $user));
	}

	public function get_edit() {} // Administrator Edit functionality
	public function put_edit() {} // Administrator Edit functionality

	public function get_profile(){

		$user = Auth::user();

		return View::make('user.profile', array('userdata' => $user));
	}

	public function put_updateData(){

		$validation = User::validate_update(Input::all());

		if ($validation->fails()) {

			return Redirect::to_route('user_profile')
				-> with_input()
				-> with_errors($validation);
		} else {

			User::update(Input::get('user_id'), array(
				'name' => Input::get('name'),
				'surname' => Input::get('surname'),
				'prefix' => Input::get('prefix'),
				'address' => Input::get('address'),
				'zipcode' => Input::get('zipcode'),
				'city' => Input::get('city'),
				'country' => Input::get('country')
				));

			return Redirect::to_route('user_profile')
				-> with('message', 'Je gegevens zijn succesvol aangepast!');
		}
	}

	public function put_updatePassword(){

		if( ! Hash::check(Input::get('old_password'), Auth::user() -> password)) {
			return Redirect::to_route('user_profile')
				-> with('message', 'Je oude wachtwoord was niet correct.');
		}

		$validation = User::validate_password(Input::all());

		if ($validation->fails()) {

			return Redirect::to_route('user_profile')
				-> with_errors($validation);
		} else {

			User::update(Input::get('user_id'), array(
				'password' => Hash::make(Input::get('password')),
			));

			return Redirect::to_route('user_profile')
				-> with('message', 'Je wachtwoord is succesvol aangepast!');
		}
	}

	public function delete_destroy() {

	}

	public function get_logout() {
		Auth::logout();
		return Redirect::to_route('home')->with('message', 'You are now logged out!');
	}

}