<?php

class Beperking extends Basemodel {
	
	public static $timestamps = false;

	public static $table = 'beperkingen';

	public function users(){
		return $this->has_many_and_belongs_to('user', 'beperkingen_per_user');
	}
	
}