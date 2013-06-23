@layout('layouts.default')

@section('content')

<!-- <div class="pageTitle">
	<div class="container">
		<h1>Hier kan een titel <small>om te pagina te verduidelijken</small></h1>
	</div>
</div> -->

<div id="mapWrapper" class="folded">
	<div id="map_canvas"></div>
	<div class="map-shadow"></div>
	<div id="map_overlay"></div><!--/map_overlay-->
	<div id="hide_map">
		<p>Verberg kaart</p><i class="icon-caret-down"></i>
	</div>
</div>

<div class="content">

	<div class="container">

		<div class="location">
            
            <div class="row-fluid location-header">
				<span class="location_formatted_address" style="display:none;">{{$location -> formatted_address}}</span>
				<span class="location_postalcode" style="display:none;">{{$location -> postalcode}}</span>
				<span class="location_number" style="display:none;">{{$location -> number}}</span>
				<span class="location_city" style="display:none;">{{$location -> city}}</span>
                <img style="cursor: pointer;" id="location-marker-img" data-id="{{$location->id}}" data-name="{{$location->name}}" data-markerimg="{{$location->img}}" data-lat="{{$location->latitude}}" data-lng="{{$location->longitude}}" src="{{ URL::to('img/maps/' . $location->img . '.png') }}" class="location-marker" />
                
                <h2 class="location-title">
					{{ $location->name }}
					<a href="{{ URL::to_route('location_feedback', $location->id) }}"><span id="location-improveInfo"><i class="icon-edit"></i><span id="location-improveInfo-text">Klopt er iets niet? Klik hier!</span></span></a>
				</h2>
            </div>

			<div class="row-fluid" style="position:relative">
				<div class="getReview">
					<h3>Beoordeling</h3>
					<table class="ratingTable">
						@if(ISSET($averageRatings))
							<tr>
								<td>Bereikbaarheid:</td>
								<td><div class="rating-read-only" data-score="{{ $averageRatings->bereikbaarheid }}"></div></td>
							</tr>
							<tr>
								<td>Parkeren:</td>
								<td><div class="rating-read-only" data-score="{{ $averageRatings->parkeren }}"></div></td>
							</tr>
							<tr>
								<td>Entree:</td>
								<td><div class="rating-read-only" data-score="{{ $averageRatings->entree }}"></div></td>
							</tr>
							<tr>
								<td>Aanlooproute:</td>
								<td><div class="rating-read-only" data-score="{{ $averageRatings->aanlooproute }}"></div></td>
							</tr>
							<tr>
								<td>Sanitair:</td>
								<td><div class="rating-read-only" data-score="{{ $averageRatings->sanitair }}"></div></td>
							</tr>
							<tr>
								<td>Liften:</td>
								<td><div class="rating-read-only" data-score="{{ $averageRatings->liften }}"></div></td>
							</tr>
							<tr>
								<td>Assistentie:</td>
								<td><div class="rating-read-only" data-score="{{ $averageRatings->assistentie }}"></div></td>
							</tr>
						@else
							<span>Deze locatie heeft nog geen<br>beoordeling ontvangen.</span>
						@endif
					</table>
				</div>

				<div class="span8">
					<ul class="nav nav-tabs" id="tab">
						<li class="active" data-type="algemeen"><a href="#general" data-toggle="tab">Algemeen</a></li>
					 	<li data-type="routebeschrijving"><a href="#route" data-toggle="tab">Routebeschrijving</a></li>
					 	<li data-type="taxibestellen"><a href="#taxi" data-toggle="tab">Taxi bestellen</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="general">
							<div class="location-quick_info">
								<ul>
				                    @if($location->formatted_address)
				                    <li class="address">{{ $location->formatted_address }}</li>
				                    @else
				                    <li class="address">{{ $location->postalcode . ' ' . $location -> number . ' ' . $location -> city }}</li>
				                    @endif                    
				                    <li class="phone"><i class="icon-phone"></i>
										@if($location -> tel)
										<a href="tel:{{ $location->tel }}">{{ $location->tel }}</a>
										@else
										Onbekend
										@endif
									</li>
				                    <li class="website"><i class="icon-globe"></i>
										@if($location -> website)
										<a href="{{ $location->website }}">{{ $location->website }}</a>
										@else
										Onbekend
										@endif
									</li>
				                    <li class="email"><i class="icon-envelope"></i>
										@if($location -> email)
										<a href="mailto:{{ $location->email }}">{{ $location->email }}</a>
										@else
										Onbekend
										@endif
									</li>
								</ul>
			                </div>
						</div>

						<div class="tab-pane" id="route">
							<div id="directions-container">
								{{ Form::open('tba', 'POST', array('class' => 'form-vertical')) }}
									{{ Form::token() }}


									<div id="controlGroupTarget" class="control-group">
										{{ Form::label('origin', 'Bepaal waar vandaan je wilt vertrekken', array('class' => 'control-label')) }}
										<div class="controls">
											<div class="input-append" style="width:80%">
												<input class="span12" id="origin-input" type="text" name="origin">
												<span class="add-on" id="get-geolocation"><i class="icon-screenshot"></i></span>
											</div>
											<span class="help-block" id="locationError" style="display: none;">Het opgegeven adres wordt niet herkend</span>
										</div>
									</div>

									<div class="control-group">
										{{ Form::label('transport', 'Op welke manier wil je er komen?', array('class' => 'control-label')) }}
										<div class="controls">
											<select name="transport" id="transport-input">
												<option value="DRIVING">Auto</option>
												<option value="TRANSIT">Openbaar vervoer</option>
												<option value="WALKING">Lopend</option>
											</select>
										</div>
									</div>

									<div class="control-group">
										<div class="controls">
											{{ Form::submit('Zoeken', array('class' => 'btn btn-primary', 'id' => 'btn_getDirections')) }}
										</div>
									</div>
								{{ Form::close() }}
							</div>

							<div id="directions-result">
								<h3>Routebeschrijving</h3>
								<ul class="unstyled"></ul>
								<a href="#" target="_blank" id="directions-gotoGMaps">Klik hier om naar Google Maps te gaan voor een uitgebreidere versie</a>
							</div>
						</div>

					  	<div class="tab-pane" id="taxi">
						  	<table>
						  		<tr>
						  			<td><b>Rotterdamse Taxi Centrale</b></td>
						  			<td><b>Stadstaxi Rotterdam</b></td>
						  			<td><b>Taxi St Job</b></td>
						  		</tr>
						  		<tr>
						  			<td><div class="taxi"><a href="tel:010 - 46 26 060"> 010 - 46 26 060</a></div></td>
						  			<td><div class="taxi"><a href="tel:010 - 81 82 823"> 010 - 81 82 823</a></div></td>
						  			<td><div class="taxi"><a href="tel:010 - 42 57 000"> 010 - 42 57 000</a></div></td>
						  		</tr>
						  		<tr>
						  			<td><div class="taxi"><a href="http://www.rtcnv.nl" target="_blank"> rtcnv.nl</a></div></td>
						  			<td><div class="taxi"><a href="http://www.stadstaxirotterdam.nl" target="_blank"> stadstaxirotterdam.nl</a></div></td>
						  			<td><div class="taxi"><a href="http://www.st-job.nl" target="_blank"> st-job.nl</a></div></td>
						  		</tr>
						  	</table>
					 	</div>
					</div>
					
				</div><!--/span8-->
				
			</div><!--/row-fluid-->

			

			<div class="row-fluid">
				<hr />
				
				<div id="setComment">
					<h3>Comments</h3>
					@if($reactions['top'])
						<span class="commentsInfo">Beste reactie</span>
						<ul class="comments top">
							@if(Auth::check() AND Auth::user()->id == $reactions['top']->user->id)
								<li id="reaction{{$reactions['top']->id}}">
									<span class="commenter">{{ $reactions['top']->user->fullname }}</span>
									<span class="date">{{ $reactions['top']->created }}</span><span class="editOn">{{ $reactions['top']->updated }}</span>
									<div class="ratings">
										<i title="Goede reacties" class="greenIcon icon-thumbs-up"> <span>{{ $reactions['top']->plus }}</span></i>
										<i title="Goede reacties" class="redIcon icon-thumbs-down"> <span>{{ $reactions['top']->min }}</span></i>	
									</div>
									<p>{{$reactions['top']->text}}</p>
									<div class="ratingHolder"><span class="reactionButton edit">Aanpassen</span> <span class="bull">&#8226;</span> <span class="reactionButton delete">Verwijderen</span></div>
								</li>
							@else
								<li id="reaction{{$reactions['top']->id}}">
									<span class="commenter">{{ $reactions['top']->user->fullname }} </span>
									<span class="date">{{ $reactions['top']->created }}</span><span class="editOn">{{ $reactions['top']->updated }}</span>
									<div class="ratings">
										<i title="Goede reacties" class="greenIcon icon-thumbs-up"> <span>{{ $reactions['top']->plus }}</span></i>
										<i title="Goede reacties" class="redIcon icon-thumbs-down"> <span>{{ $reactions['top']->min }}</span></i>	
									</div>
									<p>{{ $reactions['top']->text }}</p>
									@if(Auth::check())
										<div class="ratingHolder"><i title="Goede reactie" class="icon-thumbs-up {{$reactions['top']->clicked > 0 ? 'clicked' : ''}}"></i> <span class="bull">&#8226;</span> <i title="Slechte reactie" class="icon-thumbs-down {{$reactions['top']->clicked < 0 ? 'clicked' : ''}}"></i> <span class="bull">&#8226;</span> <i title="Raporteer reactie" class="icon-flag-alt"></i></div>
									@endif
								</li>
							@endif
							<?php unset($reactions['top']); ?>
						</ul>

						<span class="commentsInfo">Alle reacties</span>
						<ul class="comments">
							@foreach($reactions as $reaction)
								@if(Auth::check() AND Auth::user()->id == $reaction->user->id)
									<li id="reaction{{$reaction->id}}">
										<span class="commenter">{{ $reaction->user->fullname }}</span>
										<span class="date">{{ $reaction->created }}</span><span class="editOn">{{ $reaction->updated }}</span>
										<div class="ratings">
											<i title="Goede reacties" class="greenIcon icon-thumbs-up"> <span>{{ $reaction->plus }}</span></i>
											<i title="Goede reacties" class="redIcon icon-thumbs-down"> <span>{{ $reaction->min }}</span></i>	
										</div>
										<p>{{$reaction->text}}</p>
										<div class="ratingHolder"><span class="reactionButton edit">Aanpassen</span> <span class="bull">&#8226;</span> <span class="reactionButton delete">Verwijderen</span></div>
									</li>
								@else
									<li id="reaction{{$reaction->id}}">
										<span class="commenter">{{ $reaction->user->fullname }} </span>
										<span class="date">{{ $reaction->created }}</span><span class="editOn">{{ $reaction->updated }}</span>
										<div class="ratings">
											<i title="Goede reacties" class="greenIcon icon-thumbs-up"> <span>{{ $reaction->plus }}</span></i>
											<i title="Goede reacties" class="redIcon icon-thumbs-down"> <span>{{ $reaction->min }}</span></i>	
										</div>
										<p>{{ $reaction->text }}</p>
										@if(Auth::check())
											<div class="ratingHolder"><i title="Goede reactie" class="icon-thumbs-up {{$reaction->clicked > 0 ? 'clicked' : ''}}"></i> <span class="bull">&#8226;</span> <i title="Slechte reactie" class="icon-thumbs-down {{$reaction->clicked < 0 ? 'clicked' : ''}}"></i> <span class="bull">&#8226;</span> <i title="Raporteer reactie" class="icon-flag-alt"></i></div>
										@endif
									</li>
								@endif
							@endforeach
											
							@if(Auth::check())
								<li class="last">
									<span class="commenter">{{ Auth::user()->prefix ? Auth::user()->name.' '.Auth::user()->prefix.' '.Auth::user()->surname : Auth::user()->name.' '.Auth::user()->surname }}</span>
									<span class="date">{{ date('d-m-Y H:i:s') }}</span>
									<textarea id="reactionText" placeholder="Klik hier om te reageren"></textarea>
									<input class="btn" id="place" type="button" value="Plaatsen">
								</li>
							@else
								<li>
									<p>Zelf ook een reactie plaatsen? Meld je dan eerst <a href="{{ URL::to_route('login') }}">hier</a> aan op de site of registreer je op deze site via <a href="{{ URL::to_route('login') }}">deze</a> pagina.
								</li>
							@endif
						</ul>
					@else
						<ul class="comments">			
							@if(Auth::check())
								<li class="last">
									<span class="commenter">{{ Auth::user()->prefix ? Auth::user()->name.' '.Auth::user()->prefix.' '.Auth::user()->surname : Auth::user()->name.' '.Auth::user()->surname }}</span>
									<span class="date">{{ date('d-m-Y H:i:s') }}</span>
									<textarea id="reactionText" placeholder="Klik hier om te reageren"></textarea>
									<input class="btn" id="place" type="button" value="Plaatsen">
								</li>
							@else
								<li>
									<p>Zelf ook een reactie plaatsen? Meld je dan eerst <a href="{{ URL::to_route('login') }}">hier</a> aan op de site of registreer je op deze site via <a href="{{ URL::to_route('login') }}">deze</a> pagina.
								</li>
							@endif
						</ul>
					@endif
					
				</div>	

				<div class="setReview">
					<h3>Geef een beoordeling</h3>
					
					@if(Auth::check())

					{{ Form::open(URL::to_route('location_rating'), 'POST') }}
						{{ Form::token() }}
						<table class="ratingTable">
							<tr>
								<td>Bereikbaarheid:</td>
								<td><div class="rating-div" data-score="{{ @$personal_rating_data -> bereikbaarheid }}" data-category="bereikbaarheid"></div></td>
							</tr>
							<tr>
								<td>Parkeren:</td>
								<td><div style="foat:left" class="rating-div" data-score="{{ @$personal_rating_data -> parkeren }}" data-category="parkeren"></div></td>
							</tr>
							<tr>
								<td>Entree:</td>
								<td><div class="rating-div" data-score="{{ @$personal_rating_data -> entree }}" data-category="entree"></div></td>
							</tr>
							<tr>
								<td>Aanlooproute:</td>
								<td><div class="rating-div" data-score="{{ @$personal_rating_data -> aanlooproute }}" data-category="aanlooproute"></div></td>
							</tr>
							<tr>
								<td>Sanitair:</td>
								<td><div class="rating-div" data-score="{{ @$personal_rating_data -> sanitair }}" data-category="sanitair"></div></td>
							</tr>
							<tr>
								<td>Liften:</td>
								<td><div class="rating-div" data-score="{{ @$personal_rating_data -> liften }}" data-category="liften"></div></td>
							</tr>
							<tr>
								<td>Assistentie:</td>
								<td><div class="rating-div" data-score="{{ @$personal_rating_data -> assistentie }}" data-category="assistentie"></div></td>
							</tr>
						</table>
						{{ Form::hidden('location_id', $location -> id) }}
						<input type="submit" id="reviewButton" class="btn btn-primary" value="Beoordelen" />
					{{ Form::close() }}
					
					@else
					
					<p>Eerst inloggen.</p>
					
					@endif
				</div>
			</div><!--/row-fluid-->

		</div><!--/location-->
	</div><!--/container-->
</div><!--/content-->

@endsection
