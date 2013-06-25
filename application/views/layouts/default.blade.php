<!DOCTYPE html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>		<html class="no-js"> <![endif]-->
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Rotterdam Onbeperkt</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/png" href="{{ URL::to_asset('img/favicon.png') }}">
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
		<i class="icon-info"></i>
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
                            <li class="{{ (URI::is('/') ? 'active' : '') }}"><a href="{{ URL::to_route('home') }}" data-description="start hier">Home</a></li>                            
                            <li class="{{ (URI::is('locations*') ? 'active' : '') }}"><a href="{{ URL::to_route('locations') }}" data-description="naar locaties">Zoeken</a></li>
                            <li class="{{ (URI::is('news*') ? 'active' : '') }}"><a href="{{ URL::to_route('news') }}" data-description="over ons">Nieuws</a></li>
                            <li class="{{ (URI::is('contact*') ? 'active' : '') }}"><a href="{{ URL::to_route('contact') }}" data-description="opnemen">Contact</a></li>
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
    
        <div id="content" class="clearfix">
    
            @yield('content')
    
        </div>
        <div class="push"><!--//--></div>
    </div><!--/wrapper-->
    
    <footer id="footer">

        <div class="container">
    
            <div class="row-fluid">
                <div class="span4">
                    <h2>Over ons</h2>
                    <p>
                        Rotterdam Onbeperkt is ontwikkeld door vier informatica studenten van de Hogeschool Rotterdam: Remco van der Kleijn, Rob Troost, Nick van Leeuwen en Stefan Bayarri. Rotterdam Onbeperkt is ontstaan uit het Rotterdam Open Data project van de gemeente Rotterdam.
                    </p>
                </div>
                <div class="span4">
                    <h2>Nieuws</h2>
					@forelse($footer_articles as $article)
					<article class="ftArticle">
						<div class="ftArticle-publishDate">{{ date('d M \'y G:i', strtotime($article -> published_at)) }}</div>
						<div class="ftArticle-body"><a href="{{ URL::to_route('news_show', $article -> id) }}">{{ $article -> title }}</a></div>
					</article>
					@empty
					
					@endforelse
					<a href="{{ URL::to_route('news') }}">Meer nieuws...</a>
                </div>  
                <div class="span4">
                    <h2>Laatste tweet</h2>
                    
					@if( ! empty($footer_tweets))
						
						<ul class="twtr-feed">
						
						<li>
							<div class="sidebar_stream-body">{{ $footer_tweets[0]->text }}</div>
							<small>
								<em>
									<a target="_blank" class="twtr-timestamp" href="http://twitter.com/{{ $footer_tweets[0] -> user -> screen_name }}/statuses/{{ $footer_tweets[0] -> id_str }}">{{ Helpers::relative_time(strtotime($footer_tweets[0]->created_at)) }} ago</a> / <a target="_blank" class="twtr-reply" href="https://twitter.com/intent/tweet?in_reply_to={{ $footer_tweets[0] -> id_str }}">reply</a> / <a target="_blank" class="twtr-rt" href="https://twitter.com/intent/retweet?tweet_id={{ $footer_tweets[0] -> id_str }}">retweet</a> / <a target="_blank" class="twtr-fav" href="https://twitter.com/intent/favorite?tweet_id={{ $footer_tweets[0] -> id_str }}">favorite</a>
								</em>
						</li>	
							
						</ul>
					
					@else
					<p>
                        Er zijn nog geen Twitter berichten.
                    </p>
					@endif					
                </div>

            </div>
            <div id="wbFooter">
            	Mede mogelijk gemaakt door 
                <a target="_blank" id="wb_footer" href="http://www.webbundels.nl"></a> & 
                <a target="_blank" id="od_footer" href="http://www.rotterdamopendata.nl"></a> 
            </div>
    
        </div> <!-- /container -->
        
    </footer>

	{{ Asset::container('footer')->scripts() }}

	@yield('extra_scripts')

</body>
</html>