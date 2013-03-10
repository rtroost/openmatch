<?php

class User extends Eloquent {
	
	public static $timestamps = false;

	public static $key = 'user_id';

	//public static $table = 'users';

	public function interesses(){
		return $this->has_many_and_belongs_to('interesse', 'interesse_per_user');
	}

	public function beperkingen(){
		return $this->has_many_and_belongs_to('beperking', 'beperkingen_per_user');
	}

	public function vrienden(){
		return $this->has_many('vriend', 'id');
	}

	public function activiteiten(){
		return $this->has_many_and_belongs_to('activiteit', 'activiteiten_per_user');
	}
	
}