<?php

class Article extends Basemodel {

	public static $rules = array(
		'title' => 'required|between:10,200',
		'message' => 'required|min:50',
		'publish' => 'in:0,1',
	);

	public function user() {
		return $this -> belongs_to('User');
	}

	public static function get_all_published() {
		return static::where('published', '=', 1)
			-> order_by('published_at', 'DESC')
			-> get();
	}

	public static function get_amount_published($limit) {
		return static::where('published', '=', 1)
			-> order_by('published_at', 'DESC')
			-> take($limit)
			-> get();
	}
}
