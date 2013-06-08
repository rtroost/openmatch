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

    <div class="wrapper">
        <header id="header">
            <div class="container">
                <div id="header-inner">
                    <a href="{{ URL::to('/') }}"><h1 id="main_logo">Rotterdam Onbeperkt</h1></a>
                    <nav id="nav">
                        <ul>
                            <li class="{{ (URI::is('/') ? 'active' : '') }}"><a href="{{ URL::to_route('home') }}" data-description="is het begin">Home</a></li>                            
                            <li class="{{ (URI::is('locations*') ? 'active' : '') }}"><a href="{{ URL::to_route('locations') }}" data-description="naar locaties">Zoeken</a></li>
                            <li class="{{ (URI::is('news*') ? 'active' : '') }}"><a href="{{ URL::to_route('news') }}" data-description="over ons">Nieuws</a></li>
                            <li class="{{ (URI::is('contact*') ? 'active' : '') }}"><a href="{{ URL::to_route('contact') }}" data-description="met ons leggen">Contact</a></li>
                        </ul>
                        <ul class="pull-right">
                            @if( ! Auth::check())
                                <li class="{{ (URI::is('register*') ? 'active' : '') }}"><a href="{{ URL::to_route('register') }}" data-description="maak een profiel">Registreren</a></></li>
                                <li class="{{ (URI::is('login*') ? 'active' : '') }}"><a href="{{ URL::to_route('login') }}" data-description="als gebruiker">Inloggen</a></li>
                            @else
                                <li class="{{ (URI::is('profile*') ? 'active' : '') }}">{{ HTML::link_to_route('user_profile', 'Mijn profiel', Auth::user() -> id) }}</li>
                                <li>{{ HTML::link_to_route('logout', 'Uitloggen') }}</li>
                            @endif
                        </ul>            
                    </nav><!--nav-wrapper-->
                </div><!--/header-inner-->
            </div><!--/container-->
        </header><!--/header-->
    
        <div id="content">
    
            @yield('content')
    
        </div>
    </div><!--/wrapper-->
    
    <footer id="footer">

        <div class="container">
    
            <div class="row-fluid">
                <div class="span4">
                    <h2>Over ons</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel porta nulla. Morbi ullamcorper leo pretium massa viverra fermentum. Integer ultricies ante id velit commodo condimentum. Nunc elementum, sem vel iaculis egestas, elit ipsum pharetra orci, ac ultrices justo risus non nunc. Ut a elit pellentesque, venenatis dolor ut, auctor nisi. Pellentesque a massa venenatis, molestie felis ac, condimentum metus.
                    </p>
                </div>
                <div class="span4">
                    <h2>Nieuws</h2>
                </div>  
                <div class="span4">
                    <h2>Twitter Feed</h2>
                </div>
            </div>
    
        </div> <!-- /container -->
        
    </footer>

	{{ Asset::container('footer')->scripts() }}

	@yield('extra_scripts')

</body>
</html>