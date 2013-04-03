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

	public function get_show(){

	}

	public function get_edit(){

		$user = Auth::user();

		return View::make('user.edit', array('userdata' => $user));
	}

	public function put_update(){

		$validation = User::validate_update(Input::all());

		if ($validation->fails()) {
			return Redirect::to_route('edit_user', Auth::user() -> id)->with_input()->with_errors($validation);
		} else {
			User::update(Input::get('id'), array(
				'name' => Input::get('name'),
				'surname' => Input::get('surname'),
				'address' => Input::get('address'),
				'zipcode' => Input::get('zipcode'),
				'city' => Input::get('city'),
				'country' => Input::get('country')
				));

			return Redirect::to_route('edit_user', Auth::user() -> id)->with('message', 'your account had been edited');
		}
	}

	public function delete_destroy() {

	}

	public function get_logout() {
		Auth::logout();
		return Redirect::to_route('home')->with('message', 'You are now logged out!');
	}
}