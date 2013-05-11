<?php

class LocationThumb extends Basemodel {

	public static $timestamps = false;

	public static $rules = array(
		'message_body' => 'required|between:10,500'
	);

	public function location() {
		return $this -> belongs_to('Location');
	}

	public function user() {
		return $this -> belongs_to('User');
	}

	public static function get_popular($limit = NULL)
	{
		// SELECT locations.*, count(locationthumbs.positive) AS positive_thumbs FROM `locations`,`locationthumbs` WHERE `locations`.id = `locationthumbs`.location_id GROUP BY locationthumbs.id ORDER BY positive_thumbs
		return DB::query('SELECT locations.*, count(locationthumbs.positive) AS positive_thumbs FROM `locations`,`locationthumbs` WHERE `locations`.id = `locationthumbs`.location_id GROUP BY locationthumbs.id ORDER BY positive_thumbs LIMIT 0,5');

	}

}