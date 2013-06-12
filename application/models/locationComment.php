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
		return $this -> has_many('LocationComment', 'reply_id');
	}

	public function comment() {
		return $this -> belongs_to('LocationComment', 'reply_id');
	}

}