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
						<i class="icon-arrow-down"></i>
					</div>
				</div>
			</div><!--/row-fluid-->
		</div><!--/container-->
	</div><!--/map_overlay-->

	<div class="container">

		<div class="row-fluid">
			<h1 class="frontpage_title">Hier komt een welkoms tekst te staan.</h1>
			<h3 class="frontpage_subtletitle">En hier kan bijvoorbeeld een slogan komen te staan <span>OpenMatch</span></h3>
		</div><!--/row-fluid-->

	</div><!--/container-->

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
							<a href="#" class="btn btn-large">Match mij!</a>
						</p>
					</div><!--/.span6-->

				</div><!--/.frontpage-about_us_block-->

			</div><!--/.row-fluid-->

		</div><!--/.container-->

	</div>

	<div class="container">

		<div class="row-fluid">

			<div class="span6">
				<h3>Populair</h3>
				<table class="styledTable" id="fpPopular">
					<tbody>
						@for($i = 0; $i < count($popular_articles); $i++)
						@if($i == 0)
						<tr class="styledTable-position-highlight">
						@else
						<tr>
						@endif
							@if($i == 0)
							<td class="styledTable-position styledTable-position-first">{{ $i + 1 }}</td>
							@elseif($i == 1)
							<td class="styledTable-position styledTable-position-second">{{ $i + 1 }}</td>
							@elseif($i == 2)
							<td class="styledTable-position styledTable-position-third">{{ $i + 1 }}</td>
							@else
							<td>{{ $i + 1 }}</td>
							@endif
							<td>
								{{ $popular_articles[$i] -> name }}
								<span class="styledTable-tags">{{ $popular_articles[$i] -> formatted_address }}</span>
							</td>
							<td><a href="{{ URL::to_route('location', $popular_articles[$i] -> id)}}">Meer info</a>
							<!-- <td class="styledTable-rating"><span href="" class="styledTable-rating-stars" style="width: 150px"></span></td> -->
						</tr>
						@endfor
					</tbody>
				</table>
			</div><!--/.span6-->

			<div class="span6">
				<h3>Recent toegevoegd</h3>
				<table class="styledTable" id="fpRecent">
					<thead>
						<tr>
							<td>Omschrijving</td>
							<td>Moment</td>
							<td>Plaatsen beschikbaar</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Pathé Schouwburgplein<span class="styledTable-tags">Type: Restaurant - Tags: Fun</span></td>
							<td>23 maart 2013 om 21:00</td>
							<td>12/12</td>
							<td><a href="#">Meer informatie?</a></td>
						</tr>
						<tr>
							<td>Pathé Schouwburgplein<span class="styledTable-tags">Type: Restaurant - Tags: Fun</span></td>
							<td>2 maart 2013 om 13:00</td>
							<td>3/3</td>
							<td><a href="#">Meer informatie?</a></td>
						</tr>
						<tr>
							<td>Pathé Schouwburgplein<span class="styledTable-tags">Type: Restaurant - Tags: Fun</span></td>
							<td>19 februari 2013 om 23:00</td>
							<td>5/32</td>
							<td><a href="#">Meer informatie?</a></td>
						</tr>
						<tr>
							<td>Pathé Schouwburgplein<span class="styledTable-tags">Type: Restaurant - Tags: Fun</span></td>
							<td>6 februari 2013 om 22:00</td>
							<td>11/20</td>
							<td><a href="#">Meer informatie?</a></td>
						</tr>
						<tr>
							<td>Pathé Schouwburgplein<span class="styledTable-tags">Type: Restaurant - Tags: Fun</span></td>
							<td>1 februari 2013 om 16:00</td>
							<td>4/6</td>
							<td><a href="#">Meer informatie?</a></td>
						</tr>
					</tbody>
				</table>
			</div><!--/.span6-->

		</div><!--/.row-fluid-->

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

