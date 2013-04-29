<?php

class Location extends Basemodel {

	public static $timestamps = false;

	public function types(){
		return $this->has_many_and_belongs_to('type', 'locations_per_types');
	}

	public function comments() {
		return $this -> has_many('LocationComment');
	}

	public function locationThumbs() {
		return $this -> has_many('LocationThumb');
	}

	public function locationFeedback() {
		return $this -> has_many('LocationFeedback');
	}

}