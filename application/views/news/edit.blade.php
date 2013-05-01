@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span3">

				@include('administration.sidebar')

			</div><!--/span3-->

			<div class="span9">

				<h2>Nieuwsbericht aanpassen</h2>

				{{ Form::open(URL::to_route('news_update'), 'PUT', array('class' => 'form-horizontal')) }}

				{{ Form::token() }}

				{{ Form::hidden('article_id', $article -> id) }}

				<div class="control-group {{ ($errors->first('title') ? 'error' : '') }}">
					{{ Form::label('title', 'Titel', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::text('title', Input::old('title', $article->title), array('class' => 'span12')) }}
						{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group {{ ($errors->first('message') ? 'error' : '') }}">
					{{ Form::label('message', 'Bericht', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::textarea('message', Input::old('message', $article->message), array('class' => 'span12')) }}
						{{ $errors->first('message', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<div class="control-group">
					{{ Form::label('publish', 'Publiceren?', array('class' => 'control-label')) }}
					<div class="controls">
						@if($article -> published == 0)
							{{ Form::checkbox('publish', 1, false) }}
						@elseif($article -> published == 1)
							{{ Form::checkbox('publish', 0, true) }}
						@endif
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