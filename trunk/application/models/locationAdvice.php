<?php

class LocationAdvice extends Basemodel {

	public static $rules = array(
		'location-title' => 'required|max:200',
		'location-website' => 'url|max:200',
		'location-address' => 'required|max:200',
		'location-category' => 'required|max:200',
	);

	public function user() {
		return $this -> belongs_to('User');
	}

}