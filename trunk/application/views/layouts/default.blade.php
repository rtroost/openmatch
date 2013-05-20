<!DOCTYPE html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>		<html class="no-js"> <![endif]-->
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>OpenMatch - Home</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	{{ Asset::styles() }}

	{{ Asset::container('header')->scripts() }}

</head>
<body>

	<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<![endif]-->

	<!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

	@if(Session::has('message'))
	<div class="alert alert-info" id="session-message">
		<button class="close" data-dismiss="alert">&times;</button>
		{{ Session::get('message') }}
	</div>
	@endif

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				{{ HTML::link('/', 'Naam n.t.b.', array('class' => 'brand')) }}
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li class="{{ (URI::is('/') ? 'active' : '') }}"><a href="{{ URL::to_route('home') }}">Home</a></li>
						<li class="{{ (URI::is('news*') ? 'active' : '') }}"><a href="{{ URL::to_route('news') }}">Nieuws</a></li>
						<li class="{{ (URI::is('locations*') ? 'active' : '') }}"><a href="{{ URL::to_route('locations') }}">Zoek een locatie</a></li>
						<li class="{{ (URI::is('contact*') ? 'active' : '') }}"><a href="{{ URL::to_route('contact') }}">Contact</a></li>
					</ul>
					<ul class="nav pull-right">
						@if( ! Auth::check())
							<li class="{{ (URI::is('register*') ? 'active' : '') }}">{{ HTML::link_to_route('register', 'Registreren') }}</li>
							<li class="{{ (URI::is('login*') ? 'active' : '') }}">{{ HTML::link_to_route('login', 'Inloggen') }}</li>
						@else
							<li class="{{ (URI::is('profile*') ? 'active' : '') }}">{{ HTML::link_to_route('user_profile', 'Mijn profiel', Auth::user() -> id) }}</li>
							<li>{{ HTML::link_to_route('logout', 'Uitloggen') }}</li>
						@endif
					</ul>
				</div><!--/.nav-collapse -->
			</div><!--/container-->
		</div><!--/navbar-inner-->
	</div><!--/navbar navbar-fixed-top-->

	<div id="content">

		@yield('content')

	</div>

	<div class="container">

		<hr>

		<footer>
			<p>&copy; Company 2012</p>
		</footer>

	</div> <!-- /container -->

	{{ Asset::container('footer')->scripts() }}

	@yield('extra_scripts')

</body>
</html>