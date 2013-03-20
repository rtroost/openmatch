<?php

class Avtiviteit extends Basemodel {

	public static $timestamps = false;

	public static $table = 'activiteiten';

	public function users(){
		return $this->has_many_and_belongs_to('user', 'activiteiten_per_user');
	}

	public function vervoermiddelen(){
		return $this->has_many_and_belongs_to('vervoermiddel', 'vervoermiddelen_per_activiteit');
	}

	public function evenementen(){
		return $this->has_many_and_belongs_to('evenement', 'evenementen_per_activiteit');
	}

	
}