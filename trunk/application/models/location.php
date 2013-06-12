<?php

class Location extends Basemodel {

	public static $timestamps = false;

	public function types(){
		return $this->has_many_and_belongs_to('type', 'locations_per_types');
	}

	public function locationFeedback() {
		return $this -> has_many('LocationFeedback');
	}
	
	public function locationRatings() {
		return $this -> has_many('LocationRating');
	}
	
	public function recalculateScore() {
	
		$scores = LocationRating::where('location_id', '=', $this -> id) -> get();
		
		$total_avg = 0;
		
		foreach($scores as $score) {
			$total_avg += $score -> rating_avg;
		}
		
		$this -> score = $total_avg / sizeof($scores);
		$this -> score_base = sizeof($scores);
		
		$this -> save();
	}

}