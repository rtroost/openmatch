<?php

class LocationRating extends Basemodel {

	public static $table = 'location_ratings';

	public static $rules = array(
//		'feedback-input' => 'required|between:10,500'
	);

	public function location() {
		return $this -> belongs_to('location');
	}


}
