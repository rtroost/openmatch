$(document).ready(function() {
	var path = location.pathname.split("/");
	window.BASE = "http://"+ location.hostname + "/" + path[1] + "/" + path[2] + "/";
	window.IMGLOC = BASE + "img/";
});