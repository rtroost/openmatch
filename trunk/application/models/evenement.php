<?php

class Evenement extends Eloquent {

	public static $timestamps = false;

	public static $key = 'evenement_id';

	public static $table = 'evenementen';

	public function activiteiten(){
		return $this->has_many_and_belongs_to('activiteit', 'evenementen_per_activiteit');
	}

	public function reviews(){
		return $this->has_many('review', 'review_id');
	}
}