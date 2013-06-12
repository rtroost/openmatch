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
				
				<div class="span8">
					
					<div id="disqus_thread"></div>
					<script type="text/javascript">
						/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
						var disqus_shortname = 'rotterdamonbeperkt'; // required: replace example with your forum shortname
				
						/* * * DON'T EDIT BELOW THIS LINE * * */
						(function() {
							var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
							dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
							(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
						})();
					</script>
					<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
					<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
				
				</div><!--/span8-->
				
				<div class="span4">

					<h3>Beoordeling</h3>
					
					@if(Auth::check())

					<p>Dit is een eenmalige beoordeling die je kunt geven en helpt de website nauwkeuriger advies te geven, dus wees eerlijk!

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
					
					@else
					
					<p>Eerst inloggen.</p>
					
					@endif

				</div><!--/span4-->
				
			</div><!--/row-fluid-->

		</div><!--/location-->
	</div><!--/container-->
</div><!--/content-->

@endsection
