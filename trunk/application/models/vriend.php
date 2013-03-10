<?php

class Vriend extends Eloquent {

	public static $timestamps = false;

	public static $key = 'id';

	public static $table = 'vrienden';

	public function user(){
		return $this->belongs_to('user', 'user_id');
	}

	
}