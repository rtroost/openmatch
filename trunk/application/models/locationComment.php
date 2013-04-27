<?php

class LocationComment extends Basemodel {

	public static $rules = array(
		'message_body' => 'required|between:10,500'
	);

	public function location() {
		return $this -> belongs_to('Location');
	}

	public function user() {
		return $this -> belongs_to('User');
	}

	public function comments() {
		$this -> has_many('LocationComment');
	}

	public function comment() {
		$this -> belongs_to('LocationComment');
	}

}