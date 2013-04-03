@layout('layouts.default')

@section('content')

	<div id="map_canvas"></div>

	<div id="map_overlay">
		<div class="container">
			<div class="row-fluid">
				<div class="span3 offset9">
					<div id="map_overlay_inner_header">
						<h3>Zoeken</h3>
					</div>
					<div id="map_overlay_inner">
						<h5>Type uitgaansgelegenheden</h5>
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
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">

		<div class="row-fluid">
			<h1 class="frontpage_title">Hier komt een welkoms tekst te staan.</h1>
			<h3 class="frontpage_subtletitle">En hier kan bijvoorbeeld een slogan komen te staan <span>OpenMatch</span></h3>
		</div>

	</div>

	<div class="alternate_color_block">

		<div class="container">

			<div class="row-fluid">

				<div id="frontpage-about_us_block">

					<div class="span6">
						<h3>Wat is OpenMatch?</h3>
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
						</p>
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
						</p>
					</div><!--/.span6-->

					<div class="span6">
						<h3>Ik doe mee!</h3>
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
						</p>
						<p>
							<a href="#" class="btn btn-primary btn-large">Match mij!</a>
						</p>
					</div><!--/.span6-->

				</div><!--/.frontpage-about_us_block-->

			</div><!--/.row-fluid-->

		</div><!--/.container-->

	</div>

	<div class="container">

		<div class="row-fluid">

			<div class="span8">

				<div class="row-fluid">

					<div class="span6">
						<h3>Stap 1</h3>
						<div class="well"></div>
					</div><!--/.span6-->

					<div class="span6">
						<h3>Stap 2</h3>
						<div class="well"></div>
					</div><!--/.span6-->

				</div><!--/.row-fluid-->

				<div class="row-fluid">

					<div class="span6">
						<h3>Stap 3</h3>
						<div class="well"></div>
					</div><!--/.span6-->

					<div class="span6">
						<h3>Stap 4</h3>
						<div class="well"></div>
					</div><!--/.span6-->

				</div><!--/.row-fluid-->
			</div><!--/.span8-->

			<div class="span4" id="sidebar">

				<div class="side_block">
					<h3>Sign Up Now!</h3>
				</div>

			</div><!--/.span4-->
		</div><!--/.row-fluid-->

	</div><!-- /container -->

@endsection

