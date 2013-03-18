<?php

class Interesse extends Basemodel {
	
	public static $timestamps = false;

	public static $key = 'interesse_id';

	public static $table = 'interesses';

	public function users(){
		return $this->has_many_and_belongs_to('user', 'interesse_per_user');
	}

	
}