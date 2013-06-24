<?php

class EventSignup extends Basemodel {

	public static $table = "event_signups";

	public function user() {
		return $this -> belongs_to('User', 'user_id');
	}

	public function event() {
		return $this -> belongs_to('UserEvent', 'event_id');
	}
}
