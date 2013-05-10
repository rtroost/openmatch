@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="well">

				<h3>Maak je eigen evenement aan</h3>

				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>

				<a href="{{ URL::to_route('events_create') }}" class="btn">Aanmaken</a>

			</div>

		</div>

		<div class="row-fluid">

			<div class="span6">

				<h3>Aanbevolen</h3>

				@if($events_recommended)
				<table class="table table-striped eventList">
					<tbody>
						@foreach($events_recommended as $event)
						<tr>
							<td><i class="icon-angle-right"></i><a href="{{ URL::to_route('event_show', $event -> id) }}">{{ $event -> title }}</a></td>
							<td>{{ date('j M Y', strtotime($event -> event_start_stamp)) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<p>Er zijn geen aanbevelingen te maken op dit moment.</p>
				@endif

			</div><!--/span6-->

			<div class="span6">

				<h3>Recent toegevoegd</h3>

				@if($events_recent)
				<table class="table table-striped eventList">
					<tbody>
						@foreach($events_recent as $event)
						<tr>
							<td><i class="icon-angle-right"></i><a href="{{ URL::to_route('event_show', $event -> id) }}">{{ $event -> title }}</a></td>
							<td>{{ Helpers::get_timeago( strtotime($event -> created_at) ) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<p>Er zijn geen evenementen om te tonen.</p>
				@endif

			</div><!--/span6-->

		</div><!--/row-fluid-->

		<div class="row-fluid">

			<div class="span6">

				<h3>Spoedig ten einde</h3>

				@if($events_ending)
				<table class="table table-striped eventList">
					<tbody>
						@foreach($events_ending as $event)
						<tr>
							<td><i class="icon-angle-right"></i><a href="{{ URL::to_route('event_show', $event -> id) }}">{{ $event -> title }}</a></td>
							<td>{{ Helpers::get_timetogo(strtotime($event -> participation_end_stamp)) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<p>Er zijn geen evenementen die bijna ten einde zijn.</p>
				@endif

			</div><!--/span6-->

			<div class="span6">

				<h3>Bijna vol</h3>

				@if($events_nearfull)
				<table class="table table-striped eventList">
					<tbody>
						@foreach($events_nearfull as $event)
						<tr>
							<td><i class="icon-angle-right"></i><a href="{{ URL::to_route('event_show', $event -> id) }}">{{ $event -> title }}</a></td>
							<td>{{ $event -> participants_percentage }}% vol</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<p>Er zijn geen evenementen die bijna vol zitten.</p>
				@endif

			</div><!--/span6-->

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection