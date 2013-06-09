@layout('layouts.default')

@section('content')

<div class="pageTitle">
	<div class="container">
		<h1>Hier kan een titel <small>om te pagina te verduidelijken</small></h1>
	</div>
</div>

<div class="content" ng-app="locationApp">

	<div class="container" ng-controller="locationCtrl">

		<div class="row-fluid">

			<div class="span8">
				<pagination>
				</pagination>
				<locations>
				</locations>
				<pagination>
				</pagination>
			</div><!--/span9-->

			<div class="span4">
				<div class="sidebar">
					<div class="sidebar_block">
						<p>Ken je een locatie die je graag in deze lijst terug zou willen zien? Laat het ons weten!</p>
						<a href="{{ URL::to_route('location_advice') }}" class="btn btn-primary">Geef advies</a>
					</div>

					<div class="sidebar_block">
						<h4>Filter op naam</h4>
						<input class="span12" type="text" ng-model="query" ng-change="filterSearch()" placeholder="Welke locatie zoekt u?" />
					</div>

					<div class="sidebar_block">
						<h4>Filter op locatie</h4>
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
							<label for="filter_location-range" class="control-label">Maximale afstand</label>
							<div class="controls">
								<input id="filter_location-range" name="filter_location-range" class="span9" type="range" min="0" max="99" value="0" ng-model="searchRange" ng-change="rangeChange(this)" /><span id="filter_location-range-value">{{"&#123;&#123;searchRange&#125;&#125;"}}</span><!-- hier hoord { {searchRange} } te staan -->
								<span class="help-block" style="display:none;" ng-show="rangenotset" >Nog geen adres opgegeven</span>
							</div>
						</div>
					</div>

					<div class="sidebar_block">
						<h4>Filters</h4>
						<hr class="hr-small" />
						<h5>Type uitgaansgelegenheden</h5>
						<ul class="unstyled" id="locationfilter" >
							<li>
								<label class="checkbox">
									<input type="checkbox" name="bibliotheken" value="bibliotheken" ng-click="toggleType(searchTypes, 'bibliotheken')"> Bibliotheken
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="bioscopen" value="bioscopen" ng-click="toggleType(searchTypes, 'bioscopen')"> Bioscopen
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="campings" value="campings" ng-click="toggleType(searchTypes, 'campings')"> Campings
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="sportgelegenheden" value="sportgelegenheden" ng-click="toggleType(searchTypes, 'sportgelegenheden')"> Sportgelegenheden
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="kinderboerderijen" value="kinderboerderijen" ng-click="toggleType(searchTypes, 'kinderboerderijen')"> Kinderboerderijen
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="kindervermaak" value="kindervermaak" ng-click="toggleType(searchTypes, 'kindervermaak')"> Kindervermaak
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="theaters" value="theaters" ng-click="toggleType(searchTypes, 'theaters')"> Theaters
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="recreatieterreinen" value="recreatieterreinen" ng-click="toggleType(searchTypes, 'recreatieterreinen')"> Recreatieterreinen
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="zwembaden" value="zwembaden" ng-click="toggleType(searchTypes, 'zwembaden')"> Zwembaden
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="musea" value="musea" ng-click="toggleType(searchTypes, 'musea')"> Musea
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="restaurants" value="restaurants" ng-click="toggleType(searchTypes, 'restaurants')"> Restaurants
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="dierentuin" value="dierentuin" ng-click="toggleType(searchTypes, 'dierentuin')"> Dierentuin
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="attracties" value="attracties" ng-click="toggleType(searchTypes, 'attracties')"> Attracties
								</label>
							</li>
							<li>
								<label class="checkbox">
									<input type="checkbox" name="speeltuinen" value="speeltuinen" ng-click="toggleType(searchTypes, 'speeltuinen')"> Speeltuinen
								</label>
							</li>
						</ul>
					</div><!--/sidebar_block-->
				</div><!--/sidebar-->
			</div><!--/span3-->

		</div><!--/row-fluid-->
	</div><!--/container-->
</div><!--/content-->

@endsection