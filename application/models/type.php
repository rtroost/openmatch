<?php

class Type extends Basemodel {

	public static $timestamps = false;

	public function locations(){
		return $this->has_many_and_belongs_to('location', 'locations_per_types');
	}

}