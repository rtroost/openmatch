<?php

class Review extends extends Basemodel {

	public static $timestamps = false;

	public static $table = 'reviews';

	public function evenement(){
		return $this->belongs_to('evenement', 'evenement_id');
	}
	
}