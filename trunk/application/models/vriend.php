<?php

class Vriend extends extends Basemodel {

	public static $timestamps = false;

	public static $table = 'vrienden';

	public function user(){
		return $this->belongs_to('user', 'user_id');
	}

	
}