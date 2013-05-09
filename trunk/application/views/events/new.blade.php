@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span8">

				{{ Form::open(URL::to_route('events_create_post'), 'POST', array('class' => 'form-vertical')) }}

				{{ Form::token() }}

				<div class="control-group {{ ($errors->first('title') ? 'error' : '') }}">
					{{ Form::label('title', 'Titel van het evenement', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('title', Input::old('title'), array('class' => 'span12')) }}
						{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('description') ? 'error' : '') }}">
					{{ Form::label('description', 'Beschrijf het evenement in minimaal 100 tekens', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::textarea('description', Input::old('description'), array('class' => 'span12')) }}
						{{ $errors->first('description', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('location') ? 'error' : '') }}">
					{{ Form::label('location', 'Waar vind dit evenement plaats?', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('location', Input::old('location'), array('class' => 'span12')) }}
						{{ $errors->first('location', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group">
					{{ Form::label('participants-range', 'Wat is de minimale en maximale participatie aan deelnemers voor dit evenement?', array('class' => 'control-label')) }}
					<div class="controls">
						<div id="participants-range"></div><div id="participants-value"></div>
						<input type="hidden" name="participants-min" id="participants-min">
						<input type="hidden" name="participants-max" id="participants-max">
					</div>
				</div>

				<div class="control-group {{ ($errors->first('event_start') ? 'error' : '') }}">
					{{ Form::label('event_start', 'Wanneer vind dit evenement plaats?', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('event_start', Input::old('event_start'), array('class' => 'span8 date')) }}
						<select name="event_start-hours" class="span2 time_picker-hrs"></select>
						<select name="event_start-minutes" class="span2 time_picker-min"></select>
						{{ $errors->first('event_start', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('event_end') ? 'error' : '') }}">
					{{ Form::label('event_end', 'Wanneer is dit evenement ten einde?', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('event_end', Input::old('event_end'), array('class' => 'span8 date')) }}
						<select name="event_end-hours" class="span2 time_picker-hrs"></select>
						<select name="event_end-minutes" class="span2 time_picker-min"></select>
						{{ $errors->first('event_end', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('participation_end') ? 'error' : '') }}">
					{{ Form::label('participation_end', 'Wat is de uiterste inschrijfdatum voor dit evenement?', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('participation_end', Input::old('participation_end'), array('class' => 'span8 date')) }}
						<select name="participation_end-hours" class="span2 time_picker-hrs"></select>
						<select name="participation_end-minutes" class="span2 time_picker-min"></select>
						{{ $errors->first('participation_end', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						{{ Form::submit('Doorgaan', array('class' => 'btn btn-large')) }}
					</div>
				</div>

				{{ Form::close() }}
			</div><!--/span8-->

			<div class="span4">
				<h3>Hoe werkt dit?</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
			</div><!--/span4-->

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection

@section('extra_scripts')

<script>

$(function() {
	$( "#participants-range" ).slider({
		range: true,
		min: 2,
		max: 500,
		values: [ 2, 50 ],
		slide: function( event, ui ) {
			$( "#participants-min" ).val( ui.values[ 0 ] );
			$( "#participants-max" ).val( ui.values[ 1 ] );
			$( "#participants-value" ).html( 'Minimaal ' + ui.values[ 0 ] + ' en maximaal ' + ui.values[ 1 ] + ' deelnemers.');
		}
	});

	$( "#participants-min" ).val( $( "#participants-range" ).slider( "values", 0 ) );
	$( "#participants-max" ).val( $( "#participants-range" ).slider( "values", 1 ) );
	$( "#participants-value" ).html( "Minimaal " + $( "#participants-range" ).slider( "values", 0 ) +
		" en maximaal " + $( "#participants-range" ).slider( "values", 1 ) + ' deelnemers.' );

	$( ".date" ).datepicker({
		dateFormat: "DD, d MM, yy"
	});

});

$(function() {

	for(var i=0; i <= 23; i++) {
		var str = ((""+i).length > 1) ? i : "0" + i;
		$( ".time_picker-hrs" ).append('<option value="' + str  + '">' + i + '</option>');
	}

	for(var i=0; i <= 59; i = i + 5) {
		var str = ((""+i).length > 1) ? i : "0" + i;
		$( ".time_picker-min" ).append('<option value="' + str + '">' + i + '</option>');
	}

});

</script>

@endsection