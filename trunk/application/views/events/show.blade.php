@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span8">

				<h1>{{ $event -> title }}</h1>
				<p>{{ $event -> description }}</p>

				@if(count($event -> signups) < $event -> max_participants)
					@if($signedUpState)
					<a href="{{ URL::to_route('event_signoff', $event -> id) }}" class="btn">Afmelden</a>
					@else
					<a href="{{ URL::to_route('event_signup', $event -> id) }}" class="btn">Aanmelden</a>
					@endif
				@else
					<p>Dit evenement heeft zijn maximale aantal deelnemers al bereikt.</p>
				@endif

			</div><!--/span8-->

			<div class="span4">

				<div class="event-participants">

					<h4>Aanmeldingen</h4>

					@if($event -> signups)

					<table class="table table-bordered table-striped">

						@foreach($event -> signups as $participant)

						<tr>
							<td>{{ ucfirst($participant -> user -> name) . ' ' . ucfirst($participant -> user -> surname[0]) }}</td>
							<td>{{ date('M jS', strtotime($participant -> created_at)) }}</td>
						</tr>

						@endforeach

					</table>

					@else

					<p>Er zijn nog geen deelnemers.</p>

					@endif

				</div>

			</div><!--/span4-->

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection