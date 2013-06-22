<?php

class ReactionsOnLocation extends Basemodel {

	public static $timestamps = true;

	public function thumbs(){
		return $this->has_many('ThumbsOnLocationReaction', 'reactionsonlocation_id');
	}

	public function user(){
		return $this->belongs_to('User');
	}
}