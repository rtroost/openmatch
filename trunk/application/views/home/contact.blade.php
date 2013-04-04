@layout('layouts.default')

@section('content')

<div class="pageTitle">
	<div class="container">
		<h1>Kom in contact <small>en help ons verbeteren</small></h1>
	</div>
</div>

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span6">
				<h2>Wie zijn we?</h2>
				<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>

			</div><!--/span9-->

			<div class="span6">

				<h2>Iets te melden?</h2>

				{{ $errors->first('fullname', '<p>:message</p>') }}
				{{ $errors->first('email', '<p>:message</p>') }}
				{{ $errors->first('message', '<p>:message</p>') }}

				{{ Form::open('contact', 'POST', array('class' => 'form-vertical')) }}

					{{ Form::token() }}

					<div class="control-group {{ ($errors->first('fullname') ? 'error' : '') }}">
						{{ Form::label('fullname', 'Volledige naam', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('fullname', Input::old('fullname'), array('class' => 'span6')) }}
							{{ $errors->first('fullname', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('email') ? 'error' : '') }}">
						{{ Form::label('email', 'Geldig emailadres', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('email', Input::old('email'), array('class' => 'span6')) }}
							{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('message') ? 'error' : '') }}">
						{{ Form::label('message', 'Uw bericht aan ons', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::textarea('message', Input::old('message'), array('class' => 'span12')) }}
							{{ $errors->first('message', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							{{ Form::submit('Secure Login', array('class' => 'btn btn-primary')) }}
						</div>
					</div>

				{{ Form::close() }}
			</div><!--/span3-->

		</div><!--/row-fluid-->
	</div><!--/container-->
</div><!--/content-->

@endsection