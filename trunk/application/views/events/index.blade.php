@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span9">
				<div id="event_list" class="clearfix">
					<ul>
						<li class="clearfix">
							<a href="#">
								<div class="event-list-thumb">
									<img src="http://placehold.it/125x80" />
								</div>
								<div class="event-list-rating">
									98%
								</div>
								<div class="event-list-body">
									<span class="event-list-body-title">
										Pathé Schouwburgplein
									</span>
									<span class="event-list-body-description">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
									</span>
									<span class="event-list-body-metadata">
										Type: Restaurant - Tags: Rolstoelers
									</span>
								</div>
							</a>
						</li>
						<li class="clearfix">
							<a href="#">
								<div class="event-list-thumb">
									<img src="http://placehold.it/125x80" />
								</div>
								<div class="event-list-rating">
									92%
								</div>
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
						</li>
						<li class="clearfix">
							<a href="#">
								<div class="event-list-thumb">
									<img src="http://placehold.it/125x80" />
								</div>
								<div class="event-list-rating">
									89%
								</div>
								<div class="event-list-body">
									<span class="event-list-body-title">
										Op de horizon
									</span>
									<span class="event-list-body-description">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
									</span>
									<span class="event-list-body-metadata">
										Type: Restaurant - Tags: Rolstoelers
									</span>
								</div>
							</a>
						</li>
						<li class="clearfix">
							<a href="#">
								<div class="event-list-thumb">
									<img src="http://placehold.it/125x80" />
								</div>
								<div class="event-list-rating">
									78%
								</div>
								<div class="event-list-body">
									<span class="event-list-body-title">
										Pathé Schouwburgplein
									</span>
									<span class="event-list-body-description">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
									</span>
									<span class="event-list-body-metadata">
										Type: Restaurant - Tags: Rolstoelers
									</span>
								</div>
							</a>
						</li>
						<li class="clearfix">
							<a href="#">
								<div class="event-list-thumb">
									<img src="http://placehold.it/125x80" />
								</div>
								<div class="event-list-rating">
									67%
								</div>
								<div class="event-list-body">
									<span class="event-list-body-title">
										Pathé Schouwburgplein
									</span>
									<span class="event-list-body-description">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
									</span>
									<span class="event-list-body-metadata">
										Type: Restaurant - Tags: Rolstoelers
									</span>
								</div>
							</a>
						</li>
					</ul>
				</div><!--/event_list-->
			</div><!--/span9-->

			<div class="span3">
				<div class="sidebar">
					<h4>Filters</h4>
					<hr class="hr-small" />

					<h5>Evenementen</h5>
					<ul class="unstyled" >
						<li>
							<label class="checkbox">
									{{ Form::checkbox('restaurant', 'restaurant') }} Restaurant
							</label>
						</li>
						<li>
							<label class="checkbox">
									{{ Form::checkbox('cafe', 'cafe') }} Cafe
							</label>
						</li>
						<li>
							<label class="checkbox">
									{{ Form::checkbox('bioskoop', 'bioskoop') }} Bioskoop
							</label>
						</li>
						<li>
							<label class="checkbox">
									{{ Form::checkbox('museum', 'museum') }} Museum
							</label>
						</li>
						<li>
							<label class="checkbox">
									{{ Form::checkbox('casino', 'casino') }} Casino
							</label>
						</li>
						<li>
							<label class="checkbox">
									{{ Form::checkbox('pretpark', 'pretpark') }} Pretpark
							</label>
						</li>
						<li>
							<label class="checkbox">
									{{ Form::checkbox('zwembad', 'zwembad') }} Zwembad
							</label>
						</li>
						<li>
							<label class="checkbox">
									{{ Form::checkbox('bolingbaan', 'bolingbaan') }} Bolingbaan
							</label>
						</li>
						<li>
							<label class="checkbox">
									{{ Form::checkbox('theater', 'theater') }} Theater
							</label>
						</li>
					</ul>

					<h5>Afstand van jou locatie</h5>
					<input class="afstand" type="range" min="0" max="100" value="20" onchange="showValue(this.value)" style="display:block" />
					<p>
						<span id="afstand_range">20</span>
						<span> Km</span>
					</p>

					<h5>Indoor / Outdoor</h5>
					<div class="inoutdoor">
						<label class="radio inline notop">
							{{ Form::radio('inout', 'indoor') }} Indoor
						</label>
						<label class="radio inline notop">
							{{ Form::radio('inout', 'outdoor') }} Outdoor
						</label>
					</div>

					<div>
						<button class="btn btn-info" type="button">Doorvoeren</button>
						<button class="btn" type="button">Reset</button>
					</div>

				</div><!--/sidebar_block-->
			</div><!--/span3-->

		</div><!--/row-fluid-->
	</div><!--/container-->
</div><!--/content-->

<script>
	function showValue(newValue){
		document.getElementById("afstand_range").innerHTML=newValue;
	}
</script>

@endsection