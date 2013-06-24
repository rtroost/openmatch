<?php

class LocationFeedback extends Basemodel {

	public static $timestamps = false;

	public static $rules = array(
		'feedback-input' => 'required|between:10,500'
	);

	public static $table = 'locationfeedback';

	public function location() {
		return $this -> belongs_to('location');
	}


}
