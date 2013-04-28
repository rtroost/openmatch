<?php

class User extends Basemodel {

	public static $timestamps = false;

	public static $table = 'users';

	public static $rules = array(
		'email' => 'required|unique:users|email',
		'password' => 'required',
		'password_confirmation' => 'required|alpha_num|min:4',
		'name' => 'required',
		'surname' => 'required',
		'address' => 'required',
		'zipcode' => 'required|alpha_num',
		'city' => 'required',
		'country' => 'required'
	);

	public static $update_rules = array(
		'name' => 'required',
		'surname' => 'required',
		'address' => 'required',
		'zipcode' => 'required',
		'city' => 'required',
		'country' => 'required'
	);

	public static $password_rules = array(
		'password' => 'required|alpha_num|min:4|confirmed',
		'password_confirmation' => 'required|alpha_num|min:4',
	);

	public function interesses(){
		return $this->has_many_and_belongs_to('interesse', 'interesse_per_user');
	}

	public function beperkingen(){
		return $this->has_many_and_belongs_to('beperking', 'beperkingen_per_user');
	}

	public function vrienden(){
		return $this->has_many('vriend', 'id');
	}

	public function activiteiten(){
		return $this->has_many_and_belongs_to('activiteit', 'activiteiten_per_user');
	}

	public function locationThumbs() {
		return $this -> has_many('locationThumb');
	}

	public static function validate_update($data) {
		return Validator::make($data, static::$update_rules);
	}

	public static function validate_password($data) {
		return Validator::make($data, static::$password_rules);
	}

}