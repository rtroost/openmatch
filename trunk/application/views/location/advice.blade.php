@layout('layouts.default')

@section('content')

<div class="content">

	<div class="container">

		<div class="row-fluid">

			<div class="span6">

				@if(Auth::check())

				<h3>Dit formulier geheel invullen a.u.b.</h3>

				{{ Form::open(URL::to_route('location_advice_post'), 'POST', array('class' => 'form-vertical')) }}

				{{ Form::token() }}

				<div class="control-group">
					{{ Form::label('location-title', 'Wat is de naam van de locatie?', array('class' => 'control-label')) }}
					<div class="controls">
						<input class="span12" id="location-title" type="text" name="location-title" value="{{ Input::old('location-title') }}">
					</div>
					{{ $errors->first('location-title', '<span class="help-inline">:message</span>') }}
				</div>

				<div class="control-group">
					{{ Form::label('location-website', 'Wat is de website van deze aangelegenheid? (Niet verplicht)', array('class' => 'control-label')) }}
					<div class="controls">
						<input class="span12" id="location-website" type="text" name="location-website" placeholder="http://www.adres.nl/" value="{{ Input::old('location-website') }}">
					</div>
					{{ $errors->first('location-website', '<span class="help-inline">:message</span>') }}
				</div>

				<div class="control-group">
					{{ Form::label('location-address', 'Wat is het adres van deze aangelegenheid?', array('class' => 'control-label')) }}
					<div class="controls">
						<input class="span12" id="location-address" type="text" name="location-address" placeholder="Adresstraat 999, 9999 AA Rotterdam" value="{{ Input::old('location-address') }}">
					</div>
					{{ $errors->first('location-address', '<span class="help-inline">:message</span>') }}
				</div>

				<div class="control-group">
					{{ Form::label('location-category', 'In welke categorie zou deze aangelegenheid passen?', array('class' => 'control-label')) }}
					<div class="controls">
						<input class="span12" id="location-category" type="text" name="location-category" placeholder="i.e.: Restaurants, Bioscopen, etc." value="{{ Input::old('location-category') }}">
					</div>
					{{ $errors->first('location-category', '<span class="help-inline">:message</span>') }}
				</div>

				<div class="control-group">
					<div class="controls">
						{{ Form::submit('Opsturen', array('class' => 'btn')) }}
					</div>
				</div>

				{{ Form::close() }}

				@else

				<p>Wij stellen het erg op prijs dat u een locatie wilt toevoegen om deze site weer een stukje completer te maken. Om hiervan gebruik te maken vragen we wel van je dat je <a href="URL::to_route('login')">aanmeld</a> of <a href="URL::to_route('register')">registreerd</a>. Het registreer process duurt minder dan een minuut.</p>

				@endif

			</div><!--/span6-->

			<div class="span6">

				<h3>Huisregels</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>

			</div><!--/span6-->

		</div><!--/row-fluid-->

	</div><!--/container-->

</div><!--/content-->

@endsection