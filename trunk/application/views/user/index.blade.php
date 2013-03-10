@layout('master')

@section('header')
	@include('header')
@endsection

@section('container')
	<h2>Login</h2>

	{{ $errors->first('password', '<p>:message</p>') }}
	@if (Session::has('message'))
		<p>{{ Session::get('message') }}</p>
	@endif

	{{ Form::open('login') }}
		{{ Form::label('email', 'E-Mail Address') }}
		{{ Form::text('email', Session::get('form_values')['email']) }}
		{{ $errors->first('email', '<p>:message</p>') }}
		<br />

		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		<br />

		{{ Form::submit('save') }}
	{{ Form::close() }}

@endsection

@section('footer')
	@include('footer')
@endsection