@layout('layouts.default')

@section('content')

<div class="content" ng-app="locationApp">

	<div class="container" ng-controller="locationCtrl">

		<div class="row-fluid">

			<div id="zoeken_locations" class="sidebar_block span12" style="margin-bottom: 30px;">
				<!-- <h4>Filter op uitgaansgelegenheid</h4> -->
				<ul id="filter" class="inline">
					<li data-type="musea" ng-class="{active_marker_sort: musea}" ng-click="toggleType(searchTypes, 'musea'); musea = !musea;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconMuseumB.png')}}');" ></div>
						<div class="sort_tooltip" style="margin-left: -32px;">Museum</div>
					</li>
					<li data-type="speeltuinen" ng-class="{active_marker_sort: speeltuinen}" ng-click="toggleType(searchTypes, 'speeltuinen'); speeltuinen = !speeltuinen;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconPlaygroundB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -39px;">Speeltuinen</div>
					</li>
					<li data-type="bibliotheken" ng-class="{active_marker_sort: bibliotheken}" ng-click="toggleType(searchTypes, 'bibliotheken'); bibliotheken = !bibliotheken;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconLibraryB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -41px;">Bibliotheken</div>
					</li>
					<li data-type="recreatieterreinen" ng-class="{active_marker_sort: recreatieterreinen}" ng-click="toggleType(searchTypes, 'recreatieterreinen'); recreatieterreinen = !recreatieterreinen;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconRecreationB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -56px;">Recreatieterreinen</div>
					</li>
					<li data-type="kindervermaak" ng-class="{active_marker_sort: kindervermaak}" ng-click="toggleType(searchTypes, 'kindervermaak'); kindervermaak = !kindervermaak;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconKidsEntertainmentB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -48px;">Kindervermaak</div>
					</li>
					<li data-type="bioscopen" ng-class="{active_marker_sort: bioscopen}" ng-click="toggleType(searchTypes, 'bioscopen'); bioscopen = !bioscopen;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconCinemaB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -36px;">Bioscopen</div>
					</li>
					<li data-type="campings" ng-class="{active_marker_sort: campings}" ng-click="toggleType(searchTypes, 'campings'); campings = !campings;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconCampingB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -35px;">Campings</div>
					</li>
					<li data-type="kinderboerderijen" ng-class="{active_marker_sort: kinderboerderijen}" ng-click="toggleType(searchTypes, 'kinderboerderijen'); kinderboerderijen = !kinderboerderijen;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconKidsFarmB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -55px;">Kinderboerderijen</div>
					</li>
					<li data-type="dierentuin" ng-class="{active_marker_sort: dierentuin}" ng-click="toggleType(searchTypes, 'dierentuin'); dierentuin = !dierentuin;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconZooB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -37px;">Dierentuin</div>
					</li>
					<li data-type="attracties" ng-class="{active_marker_sort: attracties}" ng-click="toggleType(searchTypes, 'attracties'); attracties = !attracties;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconThemeParkB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -35px;">Attracties</div>
					</li>
					<li data-type="theaters" ng-class="{active_marker_sort: theaters}" ng-click="toggleType(searchTypes, 'theaters'); theaters = !theaters;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconTheaterB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -33px;">Theaters</div>
					</li>
					<li data-type="zwembaden" ng-class="{active_marker_sort: zwembaden}" ng-click="toggleType(searchTypes, 'zwembaden'); zwembaden = !zwembaden;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconSwimmingB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -40px;">Zwembaden</div>
					</li>
					<li data-type="sportgelegenheden" ng-class="{active_marker_sort: sportgelegenheden}" ng-click="toggleType(searchTypes, 'sportgelegenheden'); sportgelegenheden = !sportgelegenheden;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconSportsB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -60px;">Sportgelegenheden</div>
					</li>
					<li data-type="restaurants" ng-class="{active_marker_sort: restaurants}" ng-click="toggleType(searchTypes, 'restaurants'); restaurants = !restaurants;">
						<div style="background-image: url('{{URL::to_asset('img/maps/iconRestaurantB.png')}}');"></div>
						<div class="sort_tooltip" style="margin-left: -39px;">Restaurants</div>
					</li>
				</ul>
			</div>

		</div>

		<div class="row-fluid">

			<div class="span8">
				<pagination>
				</pagination>
				<locations>
				</locations>
				<pagination>
				</pagination>
			</div><!--/span8-->

			<div class="span4">
				<div class="sidebar">
					<div class="sidebar_block">
						<p>Zijn er nog locaties die niet in Rotterdam Onbeperkt staan? Laat het ons weten!</p>
						<a href="{{ URL::to_route('location_advice') }}" class="btn btn-primary">Nieuwe locatie</a>
					</div>

					<div class="sidebar_block">
						<h4>Zoek op naam</h4>
						<input class="span12" type="text" ng-model="query" ng-change="filterSearch()" placeholder="Welke locatie zoekt u?" />
					</div>

					<div class="sidebar_block">
						<h4>Zoek op locatie</h4>
						<div id="controlGroupTarget" class="control-group">
							<div class="controls">
								<div class="input-append" style="width:90%">
									<form ng-submit="submit(this)">
										<input class="span12" type="text" name="filter_location-input" ng-model="geoLocation" placeholder="Wat is uw startadres?">
										<span class="add-on" style="cursor:pointer;" ng-click="getGeoLocation(this)"><i class="icon-screenshot"></i></span>
									</form>
								</div>
								<span class="help-block" style="display:none;" ng-show="error">Het opgegeven adres wordt niet herkend</span>
							</div>
						</div>

						<div class="control-group">
							<label for="filter_location-range" class="control-label">Maximale afstand in KM</label>
							<div class="controls">
								<input id="filter_location-range" name="filter_location-range" class="span9" type="range" min="0" max="99" value="0" ng-model="searchRange" ng-change="rangeChange(this)" /><span id="filter_location-range-value">{{"&#123;&#123;searchRange&#125;&#125;"}}</span><!-- hier hoord { {searchRange} } te staan -->
								<span id="adresHelp" class="help-block" style="display:none;" ng-show="rangenotset" >Geef eerst uw adres op!</span>
							</div>
						</div>
					</div>

				</div><!--/sidebar-->
			</div><!--/span3-->

		</div><!--/row-fluid-->
	</div><!--/container-->
</div><!--/content-->

@endsection