<?php

class Evenement extends Basemodel {

	public static $timestamps = false;

	public static $table = 'evenementen';

	public function activiteiten(){
		return $this->has_many_and_belongs_to('activiteit', 'evenementen_per_activiteit');
	}

	public function reviews(){
		return $this->has_many('review', 'review_id');
	}
}