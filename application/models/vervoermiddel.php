<?php

class Vervoermiddel extends Basemodel {

	public static $timestamps = false;

	public static $table = 'vervoermiddelen';

	public function activiteiten(){
		return $this->has_many_and_belongs_to('activiteit', 'vervoermiddelen_per_activiteit');
	}

	
}