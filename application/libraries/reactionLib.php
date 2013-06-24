<?php

class ReactionLib {

	public static function postReaction($reactionOn, $id, $reaction, $userId){
		if($reactionOn == 'locations'){
			$rOL = new ReactionsOnLocation();

	 		$rOL->location_id = $id;
	 		$rOL->text = $reaction;
	 		$rOL->status = 1;
			$rOL->user_id = $userId;
	 		$reactionId = $rOL->save();

	 		if($reactionId == 0){
	 			return 0;
	 		}else{
	 			$rOL = ReactionsOnLocation::find($rOL->id);
	 			return $rOL;
	 		}
		}
	}

	public static function updateReaction($reactionOn, $id, $reaction, $userId, $reactionId){
		if($reactionOn == 'locations'){
			
			$rOL = ReactionsOnLocation::find($reactionId);
	 		$rOL->text = $reaction;
	 		$reactionId = $rOL->save();

	 		if($reactionId == 0){
	 			return 0;
	 		}else{
	 			$rOL = ReactionsOnLocation::find($rOL->id);
	 			return $rOL;
	 		}
		}
	}

	public static function deleteReaction($reactionOn, $reactionId){
		if($reactionOn == 'locations'){
			
			$rOL = ReactionsOnLocation::find($reactionId);
			$rOL->delete();
			return 1;
		}
	}

	public static function reactions($location, $userId = null){
		//$rOLs = Location::with(array('reactions', 'reactions.thumbs', 'reactions.user'))->where('id', '=', $location)->get();
		$rOLs = ReactionsOnLocation::with('thumbs')->with('user')->where('location_id', '=', $location)->get();

		$topReaction = null;
		foreach($rOLs as $key => $rOL){
			$rOL->user->fullname = $rOL->user->prefix ? $rOL->user->name.' '.$rOL->user->prefix.' '.$rOL->user->surname : $rOL->user->name.' '.$rOL->user->surname;
			$rOL->created = date('d-m-Y H:i:s', strtotime($rOL->created_at));
			$rOL->updated = $rOL->created_at != $rOL->updated_at ? '(aangepast op: '.date('d-m-Y', strtotime($rOL->updated_at)).')' : '';

			$rOL->plus = 0;
			$rOL->min = 0;
			$rOL->total = 0;
			$rOL->clicked = 0;

			foreach($rOL->thumbs as $thumb){
				if($thumb->amount < 0){
					$rOL->min++;
					$rOL->total--;
					if($userId == $thumb->user_id){
						$rOL->clicked--;
					}
				}elseif($thumb->amount == 0){

				}elseif($thumb->amount > 0){
					$rOL->total++;
					$rOL->plus++;
					if($userId == $thumb->user_id){
						$rOL->clicked++;
					}
				}
			}

			if($topReaction){
				if($rOL->total > $topReaction->total){
					$topReaction = $rOL;
				}
			}else{
				$topReaction = $rOL;
			}
		}

		$rOLs['top'] = $topReaction;

		return $rOLs;
	}

	public static function thumbReaction($reactionOn, $reactionId, $type, $userId){
		if($reactionOn == 'locations'){
			$currentThumb = ThumbsOnLocationReaction::where('reactionsonlocation_id', '=', $reactionId)->where('user_id', '=', $userId)->first();
			if($currentThumb){
				
				$newThumb = ThumbsOnLocationReaction::find($currentThumb->id);
				
				if($currentThumb->amount < 0){
					if($type == 'min'){
						$newThumb->amount = 0;
					} else{
						$newThumb->amount = 1;

					}
				} elseif($currentThumb->amount == 0){
					if($type == 'min'){
						$newThumb->amount = -1;
					} else{
						$newThumb->amount = 1;
					}
				} elseif($currentThumb->amount > 0){
					if($type == 'min'){
						$newThumb->amount = -1;
					} else{
						$newThumb->amount = 0;
					}
				}
				$newThumb->save();
			}else{

				$newThumb = new ThumbsOnLocationReaction();
				$newThumb->reactionsonlocation_id = $reactionId;
				$newThumb->user_id = $userId;


				if($type == 'min'){
					$newThumb->amount = -1;
				}else{
					$newThumb->amount = 1;
				}
				$newThumb->save();
			}
		}
	}
}