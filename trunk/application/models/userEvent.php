<?php

class UserEvent extends Basemodel {

	public static $table = "events";

	public static $rules = array(
		'title' => 'required|max:200',
		'description' => 'required|max:1000',
		'location' => 'required|max:200',
		'participants-min' => 'max:4',
		'participants-max' => 'max:4',
		'event_start' => 'required',
		'event_start-hours' => 'required',
		'event_start-minutes' => 'required',
		'event_end' => 'required',
		'event_end-hours' => 'required',
		'event_end-minutes' => 'required',
		'participation_end' => 'required',
		'participation_end-hours' => 'required',
		'participation_end-minutes' => 'required',
	);

	public function user() {
		return $this -> belongs_to('User', 'user_id');
	}

	public function signups() {
		return $this -> has_many('EventSignup', 'event_id');
	}
}
