@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span6">
				<h2>Wie zijn wij?</h2>
				<p>
					Rotterdam Onbeperkt is ontwikkeld door vier informatica studenten van de Hogeschool Rotterdam: Remco van der Kleijn, Rob Troost, Nick van Leeuwen en Stefan Bayarri. Rotterdam Onbeperkt is ontstaan uit het Rotterdam Open Data project van de gemeente Rotterdam.
				</p>

			</div><!--/span9-->

			<div class="span6">

				<h2>Vertel het ons!</h2>

				{{ Form::open('contact', 'POST', array('class' => 'form-vertical')) }}

					{{ Form::token() }}

					<div class="control-group {{ ($errors->first('fullname') ? 'error' : '') }}">
						{{ Form::label('fullname', 'Uw naam', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('fullname', Input::old('fullname'), array('class' => 'span6')) }}
							{{ $errors->first('fullname', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('email') ? 'error' : '') }}">
						{{ Form::label('email', 'Uw E-mailadres', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text('email', Input::old('email'), array('class' => 'span6')) }}
							{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group {{ ($errors->first('message') ? 'error' : '') }}">
						{{ Form::label('message', 'Uw bericht', array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::textarea('message', Input::old('message'), array('class' => 'span12')) }}
							{{ $errors->first('message', '<span class="help-inline">:message</span>') }}
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							{{ Form::submit('Verstuur', array('class' => 'btn btn-large')) }}
						</div>
					</div>

				{{ Form::close() }}
			</div><!--/span3-->

		</div><!--/row-fluid-->
	</div><!--/container-->
</div><!--/content-->

@endsection