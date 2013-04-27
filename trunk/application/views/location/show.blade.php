@layout('layouts.default')

@section('content')

<div class="pageTitle">
	<div class="container">
		<h1>Hier kan een titel <small>om te pagina te verduidelijken</small></h1>
	</div>
</div>

<div class="content">

	<div class="container">

		<div class="location">

			<div class="row-fluid">

				<div class="span5">
					<div class="location-map">
						<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:100%; height:100%;" src="https://maps.google.nl/maps?q={{$location->latitude}}+,{{$location->longitude}}&amp;output=embed"></iframe>
					</div>
				</div><!--/span5-->

				<div class="span7">

					<h3>{{ $location->name }}</h3>
					<table>
						@if( $location->website )
						<tr>
							<td>Website:</td>
							<td><a href="{{ $location->website }}">{{ $location->website }}</a></td>
						</tr>
						@endif
						<tr>
							<td>Adres:</td>
							<td>{{ $location->street }} {{ $location->number }}</td>
						</tr>
						<tr>
							<td>Postcode:</td>
							<td>{{ $location->postalcode }}</td>
						</tr>
						<tr>
							<td>Plaats:</td>
							<td>{{ $location->city }}</td>
						</tr>
						<tr>
							<td>Types:</td>
							<td>
								@foreach($location->types as $type)
									{{ $type->naam }}
								@endforeach
							</td>
						</tr>
					</table>
				</div><!--/span8-->

			</div><!--/row-fluid-->

			<div class="row-fluid">

				<hr />

				<h3>Opmerkingen en beoordelingen</h3>

				<div id="comment-container">

					<div class="comment">

						<div class="comment-inner">

							<div class="comment-inner-author">
								<a href="#">Remco van der Kleijn</a> <small>zei op 16 februari 2013:</small>
							</div><!--/comment-inner-author-->

							<div class="comment-inner-body">
								<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
							</div><!--/comment-inner-body-->

						</div><!--/comment-inner-->

						<div class="comment">

							<div class="comment-inner">

								<div class="comment-inner-author">
									<a href="#">Robbie Troost</a> <small>antwoorde 16 februari 2013 met:</small>
								</div><!--/comment-inner-author-->

								<div class="comment-inner-body">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
								</div><!--/comment-inner-body-->

							</div><!--/comment-inner-->

						</div><!--/comment-->

					</div><!--/comment-->

				</div><!--/comment-container-->

				<div id="comment_post">

					<h3>Geef je oordeel of discusseer mee!</h3>

					@if( ! Auth::check())

					<div class="comment_post-notLoggedIn">
						Je moet eerst {{ HTML::link_to_route('login', 'inloggen') }} of {{ HTML::link_to_route('register', 'registreren') }} om hier gebruik van te maken.
					</div>

					@else



					@endif

				</div>

			</div><!--/row-fluid-->

		</div><!--/location-->
	</div><!--/container-->
</div><!--/content-->

@include('handlebar-templates/locationrow')

@endsection