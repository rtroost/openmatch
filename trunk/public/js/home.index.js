$(document).ready(function() {

	maps_control.init();

	var zoekenInner = $('div#map_overlay_inner');
	var zoekenHeader = $('div#map_overlay_inner_header');
	var slide = false;
	zoekenHeader.on('click', function(){
		if(!slide){
			slide = true;
			zoekenInner.slideToggle('normal', function() {
				slide = false;
			});
		}
	});
});