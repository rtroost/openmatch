$(document).ready(function() {

	$('.hasTooltip').tooltip();

	var path = location.pathname.split("/");
	// window.BASE = "http://dev.openmatch/";
	if(location.hostname.indexOf("127.0.0.1") !== -1 || location.hostname.indexOf("localhost") !== -1){
		window.BASE = "http://"+ location.hostname + "/" + path[1] + "/" + path[2] + "/";
	} else {
		window.BASE = "http://"+ location.hostname + "/";
	}
	window.IMGLOC = BASE + "img/";
});