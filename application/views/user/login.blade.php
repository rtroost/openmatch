@layout('layouts.default')

@section('content')

<div class="pageTitle">
	<div class="container">
		<h1>Inloggen <small>voor terugkomende bezoekers</small></h1>
	</div>
</div>

<div class="content">
	<div class="container">

		<div class="row-fluid">
			<div class="span9 offset3">

				{{ $errors->first('password', '<p>:message</p>') }}

				{{ Form::open('login', 'POST', array('class' => 'form-horizontal')) }}

					{{ Form::token() }}

					<div class="control-group {{ ($errors->first('name') ? 'error' : '') }}">
						{{ Form::label('email', 'E-mailadres', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('email', Input::old('email')) }}
							{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('name') ? 'error' : '') }}">
						{{ Form::label('password', 'Wachtwoord', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::password('password') }}
							{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							{{ Form::submit('Secure Login', array('class' => 'btn btn-primary')) }}
						</div>
					</div>

				{{ Form::close() }}
			</div><!--/span9-->

		</div><!--/row-fluid-->

	</div><!--/container-->
    
</div><!--/content-->

@endsection