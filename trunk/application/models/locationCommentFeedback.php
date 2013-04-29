<?php

class LocationCommentFeedback extends Basemodel {

	public static $timestamps = false;

	public static $table = 'locationcommentfeedback';

	public static $rules = array(
		'message' => 'required|between:10,500'
	);

	public function locationComment() {
		return $this -> belongs_to('locationComment');
	}

	public function user() {
		return $this -> belongs_to('User');
	}

	public function location() {
		return $this -> belongs_to('Location');
	}


}
