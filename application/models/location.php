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

	public function reactions(){
		return $this->has_many('ReactionsOnLocation');
	}
	
	public function recalculateScore() {
	
		$scores = LocationRating::where('location_id', '=', $this -> id) -> get();
		
		$total_avg = 0;
		
		foreach($scores as $score) {
			
			// Count total average
			$total_avg += $score -> rating_avg;
			
			// Transform the rating back to an array
			$ratings = json_decode($score -> rating_dump);
					
			foreach($ratings as $key => $value) {
				
				if( ! isset($ratingsCombined[$key]))
					$ratingsCombined[$key] = 0;
				
				if( ! isset($counter[$key]))
					$counter[$key] = 0;
				
				if($value !== 0) {
					$ratingsCombined[$key] += $value;
					$counter[$key]++;
				}
				
			}
		}
		
		foreach($ratingsCombined as $key => $value) {
			$averages[$key] = $value / $counter[$key];
		}
		
		$this -> score = $total_avg / sizeof($scores);
		$this -> score_base = sizeof($scores);
		$this -> score_indivAvg = json_encode($averages);
		
		$this -> save();
	}

}