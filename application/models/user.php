<?php

class User extends Basemodel {

	public static $timestamps = false;

	public static $table = 'users';

	public static $rules = array(
		'email' => 'required|unique:users|email',
		'password' => 'required|min:4|confirmed',
		'password_confirmation' => 'required|min:4',
		'name' => 'required|between:2,200',
		'surname' => 'required|between:2,200',
		'prefix' => 'max:20',
		'address' => 'required|between:2,200',
		'zipcode' => 'required',
		'city' => 'required|between:2,200',
		'country' => 'required|between:2,200'
	);

	public static $update_rules = array(
		'name' => 'required|between:2,200',
		'surname' => 'required|between:2,200',
		'prefix' => 'max:20',
		'address' => 'required|between:2,200',
		'zipcode' => 'required',
		'city' => 'required|between:2,200',
		'country' => 'required|between:2,200'
	);

	public static $password_rules = array(
		'password' => 'required|min:4|confirmed',
		'password_confirmation' => 'required|min:4',
	);

	public function vrienden(){
		return $this->has_many('vriend', 'id');
	}

	public function locationThumbs() {
		return $this -> has_many('locationThumb');
	}

	public function events() {
		return $this -> has_many('event');
	}

	public function eventSignups() {
		return $this -> has_many('EventSignup');
	}

	public static function validate_update($data) {
		return Validator::make($data, static::$update_rules);
	}

	public static function validate_password($data) {
		return Validator::make($data, static::$password_rules);
	}

}