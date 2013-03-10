<?php

class Users_Controller extends Base_Controller {

	public $restful = true;

	public function get_index(){
		return View::make('user.index');
	}

	public function post_create(){

		$rules = array(
			'voornaam' => 'required',
			'achternaam' => 'required',
			'email' => 'required|unique:users,email|email',
			'password' => 'required|min:6|confirmed',
			'password_confirmation' => 'required|required_with:first_name',
			'adres' => 'required',
			'postcode' => 'required',
			'city' => 'required',
			'land' => 'required'
		);

		$messages = array(
			'required' => 'The :attribute field is required.',
			'unique' => 'The :attribute field already exists.'
		);

		$validation = Validator::make(Input::all(), $rules, $messages);

		$values = array(
			'voornaam' => Input::get('voornaam'),
			'achternaam' => Input::get('achternaam'),
    		'email' => Input::get('email'),
    		'password' => Hash::make(Input::get('password')),
    		'adres' => Input::get('adres'),
    		'postcode' => Input::get('postcode'),
    		'city' => Input::get('city'),
    		'land' => Input::get('land'),
    	);

		if ($validation->fails()) {
			unset($values['password']);
        	return Redirect::to_route('new_user')->with('form_values', $values)->with_errors($validation);
    	} else {
    		
    		$user = User::create($values);
    		if($user){
    			return Redirect::to_route('index')->with('message', 'your account had been created');
    		} else {
    			return 'database error';
    		}
    	}

	}

	public function get_show(){
		
	}

	public function get_edit(){

		$user = Auth::user();

		return View::make('user.edit', array('userdata' => $user));
	}

	public function get_new(){
		return View::make('user.new');
	}

	public function put_update(){

		$rules = array(
			'voornaam' => 'required',
			'achternaam' => 'required',
			'adres' => 'required',
			'postcode' => 'required',
			'city' => 'required',
			'land' => 'required'	
		);

		$messages = array(
			'required' => 'The :attribute field is required.'
		);

		$validation = Validator::make(Input::all(), $rules, $messages);

		$values = array(
			'voornaam' => Input::get('voornaam'),
			'achternaam' => Input::get('achternaam'),
    		'adres' => Input::get('adres'),
    		'postcode' => Input::get('postcode'),
    		'city' => Input::get('city'),
    		'land' => Input::get('land'),
    	);

		if ($validation->fails()) {
			return Redirect::to_route('edit_user')->with('form_values', $values)->with_errors($validation);
    	} else {

			$user = Auth::user();
			$user->fill($values);
			$user->save();
			return Redirect::to_route('edit_user')->with('message', 'your account had been edited');

    	}

	}

	public function detele_destroy(){
	
	}

	public function post_login(){

		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:6'
		);

		$messages = array(
			'required' => 'The :attribute field is required.'
		);

		$validation = Validator::make(Input::all(), $rules, $messages);

		if ($validation->fails()) {
        	return Redirect::to_route('login')->with('form_values', array('email' => Input::get('email')))->with_errors($validation);
    	} else {

			$credentials = array(
				'username' => Input::get('email'),
				'password' => Input::get('password')
			);

			if(Auth::attempt($credentials)){
				
				$user = Auth::user();

				return Redirect::to_route('index');
			}
			Session::flash('message', 'email and password combination is not correct');
			return Redirect::to_route('login')->with('form_values', array('email' => Input::get('email')));
    	}
	}

	public function get_logout(){
		Auth::logout();
		// unset any session variables
		return Redirect::to_route('index');
	}
}