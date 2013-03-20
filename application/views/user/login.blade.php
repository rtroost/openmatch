@layout('layouts.default')

@section('content')

	<div class="container">

		<div class="row-fluid">
			<h2>Login</h2>

			{{ $errors->first('password', '<p>:message</p>') }}

			{{ Form::open('login', 'POST') }}
				<p>
					{{ Form::label('email', 'E-Mail Address') }}
					{{ Form::text('email', Input::old('email')) }}
					{{ $errors->first('email', '<p>:message</p>') }}
				</p>

				<p>
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password') }}
				</p>

				{{ Form::submit('Secure Login') }}

			{{ Form::close() }}

		</div>

	</div>

@endsection