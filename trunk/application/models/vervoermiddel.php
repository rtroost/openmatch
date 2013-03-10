<?php

class Vervoermiddel extends Eloquent {

	public static $timestamps = false;

	public static $key = 'vervoermiddel_id';

	public static $table = 'vervoermiddelen';

	public function activiteiten(){
		return $this->has_many_and_belongs_to('activiteit', 'vervoermiddelen_per_activiteit');
	}

	
}