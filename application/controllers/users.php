<?php

class Users_Controller extends Base_Controller {

	public $restful = true;

	public function get_login(){
		return View::make('user.login');
	}

	public function post_login(){

		$user = array(
			'username' => Input::get('email'),
			'password' => Input::get('password')
			);

		if(Auth::attempt($user)) {
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

		if($validation->passes()) {
			User::create(array(
				'voornaam' => Input::get('voornaam'),
				'achternaam' => Input::get('achternaam'),
				'email' => Input::get('email'),
				'password' => Hash::make(Input::get('password')),
				'adres' => Input::get('adres'),
				'postcode' => Input::get('postcode'),
				'city' => Input::get('city'),
				'land' => Input::get('land')
			));

			$user = User::where_email(Input::get('email')) -> first();
			Auth::login($user);

			return Redirect::to_route('home')
				->with('message', 'Thanks for registering. You are now logged in.');
		} else {
			return Redirect::to_route('register')
				-> with_errors($validation)
				-> with_input();
		}

	}

	public function get_show(){

	}

	public function get_edit(){

		$user = Auth::user();

		return View::make('user.edit_profile', array('userdata' => $user));
	}

	public function put_update(){

		$validation = User::validate_update(Input::all());

		if ($validation->fails()) {
			return Redirect::to_route('edit_user')->with_input()->with_errors($validation);
		} else {
			User::update(Input::get('user_id'), array(
				'voornaam' => Input::get('voornaam'),
				'achternaam' => Input::get('achternaam'),
				'adres' => Input::get('adres'),
				'postcode' => Input::get('postcode'),
				'woonplaats' => Input::get('woonplaats'),
				'land' => Input::get('land')
				));

			return Redirect::to_route('edit_user')->with('message', 'your account had been edited');
		}
	}

	public function delete_destroy() {

	}

	public function get_logout() {
		if(Auth::check()) {
			Auth::logout();
			return Redirect::to_route('login')
			->with('message', 'You are now logged out!');
		} else {
			return Redirect::to_route('home');
		}
	}
}