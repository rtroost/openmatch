<h1>OpenMatch - laravel example</h1>
<nav>
	<ul>
		<li><a href="{{ URL::to_route('index') }}"> Home </a></li>
		@if (Auth::guest())
			<li><a href="{{ URL::to_route('new_user') }}"> Register </a></li>
			<li><a href="{{ URL::to_route('login') }}"> Login </a></li>
		@else
			<li><a href="{{ URL::to_route('edit_user') }}">Edit account</a></li>
			<li><a href="{{ URL::to_route('logout') }}"> Logout </a></li>
		@endif
	</ul>
<nav>
