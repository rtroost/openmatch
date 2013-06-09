@layout('layouts.default')

@section('content')

	<div id="map_canvas"></div>

	<div id="map_overlay">
		<div class="container">
			<div class="row-fluid">
				<div id="map_overlay_container" class="span3 offset9">
					<div id="map_overlay_inner">
						<ul id="filter" class="unstyled" >
							<li>
								<label class="checkbox">
										{{ Form::checkbox('bibliotheken', 'bibliotheken') }} Bibliotheken
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('bioscopen', 'bioscopen') }} Bioscopen
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('campings', 'campings') }} Campings
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('sportgelegenheden', 'sportgelegenheden') }} Sportgelegenheden
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('kinderboerderijen', 'kinderboerderijen') }} Kinderboerderijen
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('kindervermaak', 'kindervermaak') }} Kindervermaak
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('theaters', 'theaters') }} Theaters
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('recreatieterreinen', 'recreatieterreinen') }} Recreatieterreinen
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('zwembaden', 'zwembaden') }} Zwembaden
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('musea', 'musea') }} Musea
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('restaurants', 'restaurants') }} Restaurants
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('dierentuin', 'dierentuin') }} Dierentuin
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('attracties', 'attracties') }} Attracties
								</label>
							</li>
							<li>
								<label class="checkbox">
										{{ Form::checkbox('speeltuinen', 'speeltuinen') }} Speeltuinen
								</label>
							</li>
						</ul>
					</div><!--/map_overlay_inner-->
					<div id="map_overlay_inner_button">
						<i class="icon-chevron-down" style="text-shadow: 0 0 1px #fff"></i>
					</div>
				</div>
			</div><!--/row-fluid-->
		</div><!--/container-->
	</div><!--/map_overlay-->

	<div class="container" ng-app="indexApp">

		<div class="" style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0.01);
		border-left: 1px solid rgba(0, 0, 0, 0.07);
		border-right: 1px solid rgba(0, 0, 0, 0.07);
		border-bottom: 1px solid rgba(0, 0, 0, 0.07);height: 30px;"></div>

		<div id="fpLocations-container" ng-controller="tableCtrl">

			<div class="fpLocations-sortbar">
				<ul>
					<li><i class="icon-reorder hasTooltip" data-toggle="tooltip" title="Toon" ng-click="changeRoute('')"></i></li>
					<li><i class="icon-screenshot hasTooltip" data-toggle="tooltip" title="Locatie's dichtbij" ng-click="changeRoute('locatie_dichtbij')"></i></li>
					<li><i class="icon-trophy hasTooltip" data-toggle="tooltip" title="Hoogst beoordeeld" ng-click="changeRoute('hoogst_beoordeeld')"></i></li>
					<li><i class="icon-star hasTooltip" data-toggle="tooltip" title="Aanbevolen" ng-click="changeRoute('aanbevolen')"></i></li>
				</ul>
			</div><!--/span1-->

			<div class="fpLocations-right" ng-view>

				

			</div><!--/span11-->

		</div><!--/row-fluid-->

		<!-- <div class="row-fluid">
			<h1 class="frontpage_title">Hier komt een welkoms tekst te staan.</h1>
			<h3 class="frontpage_subtletitle">En hier kan bijvoorbeeld een slogan komen te staan <span>Naam n.t.b.</span></h3>
		</div> --><!--/row-fluid-->

	</div><!--/container-->

	<div class="alternate_color_block">

		<div class="container">

			<div class="row-fluid">

				<div id="frontpage-about_us_block">

					<div class="span12">
						<h3>Wat is dit precies?</h3>
						<p>
							Rotterdam is een stad vol leven dat gedeeld moet worden met zijn inwoners. Hieronder vallen ook onze minder valide inwoners. Deze website is opgezet om jullie tegemoet te komen in jullie ervaring met alles dat Rotterdam te bieden heeft.
						</p>
						<p>
							Het ontwikkelteam Djoezzy van de Hogeschool Rotterdam, bestaande uit Remco van der Kleijn, Stefan Bayarri, Nick van Leeuwen en Rob Troost, heeft ervoor gezorgt dat ook als je in een roelstoel zit je nogsteeds precies weet wat Rotterdam je te bieden heeft. De ontwikkeling van OpenMatch is gebaseerd op een 'Community Driven' principe waar de nauwkeurigheid van de website door de gebruiker verbeterd wordt. Zo helpt iedereen elkaar. Het enige dat jij hoeft te doen, is er gebruik van te maken.
						</p>
						<p>
							Wij danken Rotterdam Open Data voor hun uitzonderlijke hoeveelheid gegevens die de basis hebben gevormd voor dit project.
						</p>
					</div><!--/.span6-->

				</div><!--/.frontpage-about_us_block-->

			</div><!--/.row-fluid-->

		</div><!--/.container-->

	</div>

    <div class="container">

		<div class="row-fluid">

			<div class="span6">

				<div id="fpArticles-container">

					<h3>OpenMatch ontwikkelingen</h3>

					@foreach($articles as $article)

					<div class="fpArticle clearfix">

						<div class="fpArticle-publishedDate">{{ date('j M', intval($article -> published_at)) }}</div>
						<div class="fpArticle-title"><a href="{{ URL::to_route('news_show', $article -> id) }}">{{ $article -> title }}</a></div>

					</div><!--/fpArticle-->

					@endforeach

				</div>

				<a href="{{ URL::to_route('news') }}">Lees de rest van ons nieuws!</a>

			</div><!--/span6-->

			<div class="span6">

			</div><!--/span6-->

		</div>

	</div><!-- /container -->

@endsection

