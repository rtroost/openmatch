@layout('layouts.default')

@section('content')

<div class="pageTitle">
	<div class="container">
		<h1>Hier kan een titel <small>om te pagina te verduidelijken</small></h1>
	</div>
</div>

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span9">
				<div id="event_list" class="clearfix">
					<ul id="locationWrapper">
						<!-- <li class="clearfix">
							<a href="#">
								<div class="event-list-body">
									<span class="event-list-body-title">
										De dronken geit
									</span>
									<span class="event-list-body-description">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
									</span>
									<span class="event-list-body-metadata">
										Type: Restaurant - Tags: Rolstoelers
									</span>
								</div>
							</a>
						</li> -->
					</ul>
				</div><!--/event_list-->
			</div><!--/span9-->

			<div class="span3">
				<div class="sidebar">
					<h4>Filters</h4>
					<hr class="hr-small" />

					<h5>Type uitgaansgelegenheden</h5>
					<ul class="unstyled" id="locationfilter" >
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

				</div><!--/sidebar_block-->
			</div><!--/span3-->

		</div><!--/row-fluid-->
	</div><!--/container-->
</div><!--/content-->

@include('handlebar-templates/locationrow')

@endsection