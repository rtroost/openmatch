@layout('layouts.default')

@section('content')

	<div id="mapWrapper">
		<div id="map_canvas"></div>
		<div class="map-shadow"></div>
		<div id="map_overlay" style="display: none;"></div><!--/map_overlay-->
		<div id="hide_map">
			<p>Verberg kaart</p><i class="icon-caret-up"></i>
		</div>
	</div>

	<div id="map_underlay">
		<ul id="filter" class="inline">
			<li data-type="musea">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconMuseumB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -32px;">Museum</div>
			</li>
			<li data-type="speeltuinen">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconPlaygroundB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -39px;">Speeltuinen</div>
			</li>
			<li data-type="bibliotheken">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconLibraryB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -41px;">Bibliotheken</div>
			</li>
			<li data-type="recreatieterreinen">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconRecreationB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -56px;">Recreatieterreinen</div>
			</li>
			<li data-type="kindervermaak">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconKidsEntertainmentB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -48px;">Kindervermaak</div>
			</li>
			<li data-type="bioscopen">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconCinemaB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -36px;">Bioscopen</div>
			</li>
			<li data-type="campings">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconCampingB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -35px;">Campings</div>
			</li>
			<li data-type="kinderboerderijen">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconKidsFarmB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -55px;">Kinderboerderijen</div>
			</li>
			<li data-type="dierentuin">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconZooB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -37px;">Dierentuin</div>
			</li>
			<li data-type="attracties">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconThemeParkB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -35px;">Attracties</div>
			</li>
			<li data-type="theaters">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconTheaterB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -33px;">Theaters</div>
			</li>
			<li data-type="zwembaden">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconSwimmingB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -40px;">Zwembaden</div>
			</li>
			<li data-type="sportgelegenheden">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconSportsB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -60px;">Sportgelegenheden</div>
			</li>
			<li data-type="restaurants">
				<div style="background-image: url('{{URL::to_asset('img/maps/iconRestaurantB.png')}}');"></div>
				<div class="sort_tooltip" style="margin-left: -39px;">Restaurants</div>
			</li>
		</ul>
	</div>

	<div class="container" ng-app="indexApp" ng-controller="tableCtrl">

		<div class="" style="4
		background: none repeat scroll 0 0 rgba(0, 0, 0, 0.01);
		border-bottom: 1px solid rgba(0, 0, 0, 0.07);">

			<div class="row-fluid">
				<div class="span12">
					<div id="controlGroupTarget" class="control-group" style="text-align: center; margin-top: 10px;">
						<div class="controls">
							<div class="input-append" style="width:90%; margin-bottom: 0px;">
								<form ng-submit="submit(this)" style="margin-bottom: 0px">
									<input class="span8" type="text" name="filter_location-input" ng-model="geoLocation" placeholder="Wat is uw adres?">
									<span class="add-on" style="cursor:pointer;" ng-click="getGeoLocation(this)"><i class="icon-screenshot"></i></span>
								</form>
							</div>
							<span class="help-block" style="display:none;" ng-show="error">Het opgegeven adres wordt niet herkend</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="fpLocations-container" style="
			border-left: 1px solid rgba(0, 0, 0, 0.07);
			border-right: 1px solid rgba(0, 0, 0, 0.07);">

			<div class="fpLocations-sortbar">
				<ul>
					<li ng-click="changeRoute('')"><i class="icon-reorder hasTooltip" data-toggle="tooltip" title="Willekeurig"></i></li>
					<li ng-click="changeRoute('locatie_dichtbij')"><i class="icon-screenshot hasTooltip" data-toggle="tooltip" title="Locatie's dichtbij"></i></li>
					<li ng-click="changeRoute('hoogst_beoordeeld')"><i class="icon-trophy hasTooltip" data-toggle="tooltip" title="Hoogst beoordeeld"></i></li>
					<li ng-click="changeRoute('aanbevolen')"><i class="icon-star hasTooltip" data-toggle="tooltip" title="Aanbevolen"></i></li>
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
						<h3>Wat is Rotterdam Onbeperkt?</h3>
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

	</div><!--/alternate_color block-->

@endsection