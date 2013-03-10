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

		<p> Your email address: {{ $userdata->email }} </p>

		{{ Form::label('voornaam', 'Voornaam') }}
		@if(Session::has('form_values'))
			{{ Form::text('voornaam', Session::get('form_values.voornaam')) }}
		@else
			{{ Form::text('voornaam', $userdata->voornaam) }}
		@endif
		{{ $errors->first('voornaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('achternaam', 'Achternaam') }}
		@if(Session::has('form_values'))
			{{ Form::text('achternaam', Session::get('form_values.achternaam')) }}
		@else
			{{ Form::text('achternaam', $userdata->achternaam) }}
		@endif
		{{ $errors->first('achternaam', '<p>:message</p>') }}
		<br />

		{{ Form::label('adres', 'Adres') }}
		@if(Session::has('form_values'))
			{{ Form::text('adres', Session::get('form_values.adres')) }}
		@else
			{{ Form::text('adres', $userdata->adres) }}
		@endif
		{{ $errors->first('adres', '<p>:message</p>') }}
		<br />

		{{ Form::label('postcode', 'Postcode') }}
		@if(Session::has('form_values'))
			{{ Form::text('postcode', Session::get('form_values.postcode')) }}
		@else
			{{ Form::text('postcode', $userdata->postcode) }}
		@endif
		{{ $errors->first('postcode', '<p>:message</p>') }}
		<br />

		{{ Form::label('city', 'Stad') }}
		@if(Session::has('form_values'))
			{{ Form::text('city', Session::get('form_values.city')) }}
		@else
			{{ Form::text('city', $userdata->city) }}
		@endif
		{{ $errors->first('city', '<p>:message</p>') }}
		<br />

		{{ Form::label('land', 'Land') }}
		@if(Session::has('form_values'))
			{{ Form::text('land', Session::get('form_values.land')) }}
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