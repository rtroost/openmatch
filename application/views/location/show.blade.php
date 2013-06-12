@layout('layouts.default')

@section('content')

<!-- <div class="pageTitle">
	<div class="container">
		<h1>Hier kan een titel <small>om te pagina te verduidelijken</small></h1>
	</div>
</div> -->

<div class="content">

	<div class="container">

		<div class="location">
            
            <div class="row-fluid location-header">
                
                <img src="{{ URL::to('img/maps/' . $location->img . '.png') }}" class="location-marker" />
                
                <h2 class="location-title">{{ $location->name }}</h2>
                <div class="location-quick_info">
                    @if($location->formatted_address)
                    <span class="address">{{ $location->formatted_address }}</span>
                    @else
                    <span class="address">{{ $location->postalcode . ' ' . $location -> city }}</span>
                    @endif
                    @if($location -> tel)
                    <span class="phone">{{ $location->tel }}</span>
                    @endif
                    @if($location -> website)
                    <span class="website"><a href="{{ $location->website }}">{{ $location->website }}</a></span>
                    @else
                    @endif
                    @if($location -> email)
                    <span class="email"><a href="mailto:{{ $location->email }}">{{ $location->email }}</a></span>
                    @else
                    @endif
                </div>

            </div>

			<div class="row-fluid">
                
				<div class="span4">
					<div class="location-map">
						<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:100%; height:100%;" src="https://maps.google.nl/maps?q={{$location->latitude}}+,{{$location->longitude}}&amp;output=embed"></iframe>
					</div>
				</div><!--/span5-->

				<div class="span8">

					<ul class="nav nav-tabs">
					  <li class="active"><a href="#route" data-toggle="tab">Routebeschrijving</a></li>
					  <li><a href="#taxi" data-toggle="tab">Taxi bestellen</a></li>
					  <li><a href="#feedback" data-toggle="tab">Feedback geven</a></li>
					</ul>

					<div class="tab-content">
					  <div class="tab-pane active" id="route">
					  	<div id="directions-container">

								{{ Form::open('tba', 'POST', array('class' => 'form-vertical')) }}

								{{ Form::token() }}

								<span class="location_formatted_address" style="display:none;">{{$location -> formatted_address}}</span>
								<span class="location_postalcode" style="display:none;">{{$location -> postalcode}}</span>
								<span class="location_number" style="display:none;">{{$location -> number}}</span>
								<span class="location_city" style="display:none;">{{$location -> city}}</span>

								<div id="controlGroupTarget" class="control-group">
									{{ Form::label('origin', 'Bepaal waar vandaan je wilt vertrekken', array('class' => 'control-label')) }}
									<div class="controls">
										<div class="input-append" style="width:80%">
											<input class="span12" id="origin-input" type="text" name="origin">
											<span class="add-on" id="get-geolocation"><i class="icon-screenshot"></i></span>
										</div>
										<span class="help-block" id="locationError" style="">Het opgegeven adres wordt niet herkend</span>
									</div>
								</div>

								<div class="control-group">
									{{ Form::label('transport', 'Op welke manier wil je er komen?', array('class' => 'control-label')) }}
									<div class="controls">
										<select name="transport" id="transport-input">
											<option value="driving">Auto</option>
											<option value="transit">Openbaar vervoer</option>
											<option value="walking">Lopend</option>
											<option value="bicycling">Fietsend</option>
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

					  	<p>Wij raden De Roo Taxi en Autoverhuur aan voor al uw taxi-gerelateerde wensen.</p>
					  	<img src="{{ URL::to_asset('img/de-roo-logo.png') }}" alt="De Roo" width="190" height="49" />
					  	<br />
					  	<p><b>Telefoonnummer: </b> 0174 624441</p>

					  </div>

					  <div class="tab-pane" id="feedback">

					  	@if(Auth::check())

					  	{{ Form::open(URL::to_route('location_feedback', $location -> id), 'POST', array('class' => 'form-vertical')) }}

							{{ Form::token() }}

							{{ Form::hidden('location_id', $location -> id) }}

							<div class="control-group">
								{{ Form::label('feedback-input', 'Welke fout in onze informatie wilt u doorgeven?', array('class' => 'control-label')) }}
								<div class="controls">
									<textarea class="input-xxlarge" type="text" name="feedback-input" id="feedback-input" rows="5" placeholder="Beschrijf alsjeblieft zo duidelijk mogelijk welk onderdeel aan informatie op deze pagina niet correct is"></textarea>
								</div>
							</div>

							<div class="control-group">
								<div class="controls">
									{{ Form::submit('Feedback doorgeven', array('class' => 'btn btn-primary')) }}
								</div>
							</div>

							@else

							<p>Wij stellen het erg op prijs wanneer onze gebruikers mee willen helpen de informatie op de website in orde te houden maar hiervoor vragen wij wel van u om een account aan te maken of door in te loggen met een bestaande account.</p>
							<a href="{{URL::to_route('login')}}" class="btn">Aanmelden</a>
							<a href="{{URL::to_route('register')}}" class="btn">Registreren</a>

							@endif

							{{ Form::close() }}

					  </div><!--#feedback-->

					</div>

				</div><!--/span8-->

			</div><!--/row-fluid-->

			<div class="row-fluid">

				<hr />

				<div id="comment-feedback" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Een fout in de reacties doorgeven</h3>
					</div>
					<div class="modal-body">

						{{ Form::open(NULL, NULL, array('id' => 'form-comment_feedback')) }}

						{{ Form::token() }}

						{{ Form::hidden('location_id', $location -> id, array('id' => 'comment-feedback-location_id')) }}
						{{ Form::hidden('comment_id', NULL, array('id' => 'comment-feedback-comment_id')) }}

						<label for="comment-feedback-message">Wat is er mis met dit bericht? Als je dit bericht als offensief ervaart, gebruik dan het vlag (<i class="icon-flag"></i>) icoontje.</label>
						<textarea name="message" name="comment-feedback-message" id="comment-feedback-message" rows="5" class="span12"></textarea>

						{{ Form::close() }}

					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Sluiten</button>
						<button class="btn btn-primary" onClick="javascript:comment_postFeedback()">Versturen</button>
					</div>
				</div>
                
                @if($location -> comments)

				<div id="comment-container">
                    
                    <h3>Opmerkingen en beoordelingen</h3>
                    
                    @foreach($location -> comments as $comment)

                    <div class="comment" id="comment-{{$comment -> id}}">

                        <div class="comment-inner">

                            <div class="comment-inner-options">
                                <a href="#" data-toggle="tooltip" title="Reageer op dit bericht" class="hasTooltip"><i class="icon-reply"></i></a>
                                <a href="#" data-toggle="tooltip" title="Foutieve informatie in dit bericht?" class="hasTooltip" onClick="javascript:comment_openFeedback({{$comment -> id}})"><i class="icon-warning-sign"></i></a>
                                <a href="#" data-toggle="tooltip" title="Rapporteer dit bericht als offensief" class="hasTooltip"><i class="icon-flag"></i></a>
                            </div><!--/comment-inner-options-->

                            <div class="comment-inner-author">
                                <a href="{{ URL::to_route('show_profile', $comment -> user -> id) }}">{{ ucwords($comment -> user -> name) . ' ' . $comment -> user -> prefix . ' '. ucwords($comment -> user -> surname) }}</a> <small>zei op {{ date('j F Y \o\m G:i', strtotime($comment -> created_at)) }}:</small>
                            </div><!--/comment-inner-author-->

                            <div class="comment-inner-body">
                                {{ $comment -> body }}
                            </div><!--/comment-inner-body-->

                        </div><!--/comment-inner-->

                    </div><!--/comment-->
                    @endforeach
                    
				</div><!--/comment-container-->
                
                @else
                    <p>Er bestaan nog geen reacties voor deze locatie. Je kan de eerste zijn!</p> 
                    
                @endif

				<div id="comment_post" class="wrapper clearfix">

					<div class="span8">

						<h3>Geef je oordeel of discusseer mee!</h3>

						@if( ! Auth::check())

						<p>
							Je moet eerst {{ HTML::link_to_route('login', 'aanmelden') }} of {{ HTML::link_to_route('register', 'registreren') }} om hier gebruik van te maken.
						</p>

						@else

						{{ Form::open(URL::to_route('location_post_comment', $location -> id), 'POST', array('class' => 'form-verticle')) }}

						{{ Form::token() }}

						{{ Form::hidden('location_id', $location -> id) }}

						<div class="control-group {{ ($errors->first('message_body') ? 'error' : '') }}">
							{{ Form::label('message_body', 'Uw bericht', array('class' => 'control-label')) }}
							<div class="controls">
								{{ Form::textarea('message_body', Input::old('message_body'), array('class' => 'span12')) }}
								{{ $errors->first('message_body', '<span class="help-inline">:message</span>') }}
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								{{ Form::submit('Verstuur', array('class' => 'btn btn-large')) }}
							</div>
						</div>

						{{ Form::close() }}

						@endif

					</div><!--/span8-->

					<div class="span4">

						<h3>Beoordeling</h3>
						
						@if(Auth::check())

						<p>Dit is een eenmalige beoordeling die je kunt geven en helpt de website nauwkeuriger advies te geven, dus wees eerlijk!

						<div class="row-fluid">
							{{ Form::open(URL::to_route('location_rating'), 'POST') }}
							{{ Form::token() }}
							<p>Berijkbaarheid</p>
							<div class="rating-div" data-score="{{ @$personal_rating_data -> berijkbaarheid }}" data-category="berijkbaarheid"></div>
							<p>Parkeren</p>
							<div class="rating-div" data-score="{{ @$personal_rating_data -> parkeren }}" data-category="parkeren"></div>
							<p>Entree</p>
							<div class="rating-div" data-score="{{ @$personal_rating_data -> entree }}" data-category="entree"></div>
							<p>Aanlooproute</p>
							<div class="rating-div" data-score="{{ @$personal_rating_data -> aanlooproute }}" data-category="aanlooproute"></div>
							<p>Sanitair</p>
							<div class="rating-div" data-score="{{ @$personal_rating_data -> sanitair }}" data-category="sanitair"></div>
							<p>Liften</p>
							<div class="rating-div" data-score="{{ @$personal_rating_data -> liften }}" data-category="liften"></div>
							<p>Assistentie</p>
							<div class="rating-div" data-score="{{ @$personal_rating_data -> assistentie }}" data-category="assistentie"></div>
							
							{{ Form::hidden('location_id', $location -> id) }}
							<input type="submit" class="btn btn-primary" value="Doorvoeren!" />
							
							{{ Form::close() }}
						</div><!--/row-fluid-->
						
						@else
						
						<p>Eerst inloggen.</p>
						
						@endif

					</div><!--/span4-->

				</div>

			</div><!--/row-fluid-->

		</div><!--/location-->
	</div><!--/container-->
</div><!--/content-->

@endsection
