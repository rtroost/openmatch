@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Registreren</h2>

	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	{{ Form::open('users', 'PUT') }}

		{{ Form::hidden('id', $userdata->user_id) }}

		<p> Your email address: {{ $userdata->email }} </p>

		{{ Form::label('voornaam', 'Voornaam') }}
		@if(Input::old('voornaam'))
			{{ Form::text('voornaam', Input::old('voornaam')) }}
		@else
			{{ Form::text('voornaam', $userdata->voornaam) }}
		@endif
		{{ $errors->first('voornaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('achternaam', 'Achternaam') }}
		@if(Input::old('achternaam'))
			{{ Form::text('achternaam', Input::old('achternaam')) }}
		@else
			{{ Form::text('achternaam', $userdata->achternaam) }}
		@endif
		{{ $errors->first('achternaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('adres', 'Adres') }}
		@if(inptu::old('adres'))
			{{ Form::text('adres', Input::old('adres')) }}
		@else
			{{ Form::text('adres', $userdata->adres) }}
		@endif
		{{ $errors->first('adres', '<p>:message</p>') }}
		<br />

		{{ Form::label('postcode', 'Postcode') }}
		@if(Input::old('postcode'))
			{{ Form::text('postcode', Input::old('postcode')) }}
		@else
			{{ Form::text('postcode', $userdata->postcode) }}
		@endif
		{{ $errors->first('postcode', '<p>:message</p>') }}
		<br />

		{{ Form::label('woonplaats', 'Woonplaats') }}
		@if(Input::old('woonplaats'))
			{{ Form::text('woonplaats', Input::old('woonplaats')) }}
		@else
			{{ Form::text('woonplaats', $userdata->woonplaats) }}
		@endif
		{{ $errors->first('woonplaats', '<p>:message</p>') }}
		<br />

		{{ Form::label('land', 'Land') }}
		@if(Input::old('land'))
			{{ Form::text('land', Input::old('land')) }}
		@else
			{{ Form::text('land', $userdata->land) }}
		@endif
		{{ $errors->first('land', '<p>:message</p>') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection