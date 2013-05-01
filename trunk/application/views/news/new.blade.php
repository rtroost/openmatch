@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span3">

				@include('administration.sidebar')

			</div><!--/span3-->

			<div class="span9">

				<h2>Nieuwsbericht toevoegen</h2>

				{{ Form::open(URL::to_route('news_create_post'), 'POST', array('class' => 'form-horizontal')) }}

				{{ Form::token() }}

				<div class="control-group {{ ($errors->first('title') ? 'error' : '') }}">
					{{ Form::label('title', 'Titel', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('title', Input::old('title'), array('class' => 'span12')) }}
						{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('message') ? 'error' : '') }}">
					{{ Form::label('message', 'Bericht', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::textarea('message', Input::old('message'), array('class' => 'span12')) }}
						{{ $errors->first('message', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group">
					{{ Form::label('publish', 'Direct publiceren?', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::checkbox('publish', 1, false) }}
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						{{ Form::submit('Opslaan', array('class' => 'btn btn-large')) }}
						<a href="{{ URL::to_route('news_manage') }}" class="btn btn-large">Annuleren</a>
					</div>
				</div>

				{{ Form::close() }}

			</div><!--/span9-->

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection