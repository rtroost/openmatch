<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title>OpenMatch</title>
		{{ HTML::style('css/style.css') }}
	</head>
	<body>

		<header id="pageHeader"> @yield('header') </header>

		<div id="pageContainer"> @yield('container') </div>

		<footer id="pageFooter"> @yield('footer') </footer>

	</body>
</html>