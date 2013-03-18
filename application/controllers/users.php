<?php

class Users_Controller extends Base_Controller {

	public $restful = true;

	public function get_login(){
		return View::make('user.login');
	}

	public function post_create(){

		$validation = User::validate(Input::all());

		if ($validation->fails()) {
        	return Redirect::to_route('new_user')->with_input()->with_errors($validation);
    	} else {
    		
    		$user = User::create(array(
				'voornaam' => Input::get('voornaam'),
				'achternaam' => Input::get('achternaam'),
	    		'email' => Input::get('email'),
	    		'password' => Hash::make(Input::get('password')),
	    		'adres' => Input::get('adres'),
	    		'postcode' => Input::get('postcode'),
	    		'woonplaats' => Input::get('woonplaats'),
	    		'land' => Input::get('land'),
	    	));

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

		$validation = User::validate_update(Input::all());

		if ($validation->fails()) {
			return Redirect::to_route('edit_user')->with_input()->with_errors($validation);
    	} else {
    		User::update(Input::get('id'), array(
					'voornaam' => Input::get('voornaam'),
					'achternaam' => Input::get('achternaam'),
		    		'adres' => Input::get('adres'),
		    		'postcode' => Input::get('postcode'),
		    		'woonplaats' => Input::get('woonplaats'),
		    		'land' => Input::get('land'),
		    	)
    		);

			return Redirect::to_route('edit_user')->with('message', 'your account had been edited');
    	}
	}

	public function detele_destroy(){
	
	}

	public function post_login(){

		$validation = User::validate_login(Input::all());

		if ($validation->fails()) {
        	return Redirect::to_route('login')->with_input()->with_errors($validation);
    	} else {

			$credentials = array(
				'username' => Input::get('email'),
				'password' => Input::get('password')
			);

			if(Auth::attempt($credentials)){
				return Redirect::to_route('index');
			}
			return Redirect::to_route('login')->with_input()->with('message', 'email and password combination is not correct');
    	}
	}

	public function get_logout(){
		Auth::logout();
		return Redirect::to_route('index');
	}
}