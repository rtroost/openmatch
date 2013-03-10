<?php

class Review extends Eloquent {

	public static $timestamps = false;

	public static $key = 'review_id';

	public static $table = 'reviews';

	public function evenement(){
		return $this->belongs_to('evenement', 'evenement_id');
	}
	
}