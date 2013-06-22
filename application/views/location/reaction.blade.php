<li id="reaction{{$reaction->id}}">
	<span class="commenter">{{$fullname}}</span>
	<span class="date">{{ date('d-m-Y H:i:s', strtotime($reaction->created_at)) }} </span> {{ $reaction->created_at != $reaction->updated_at ? '<span class="editOn">(aangepast op: '.date('d-m-Y', strtotime($reaction->updated_at)).')</span>' : ''; }}
	<p>{{$reaction->text}}</p>
	<div class="ratingHolder"><span class="reactionButton edit">Aanpassen</span> <span class="bull">&#8226;</span> <span class="reactionButton delete">Verwijderen</span></div>
</li>