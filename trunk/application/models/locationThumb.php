<?php

class locationThumb extends Basemodel {

	public static $timestamps = false;

	public static $rules = array(
		'message_body' => 'required|between:10,500'
	);

	public function location() {
		return $this -> belongs_to('Location');
	}

	public function user() {
		return $this -> belongs_to('User');
	}

}