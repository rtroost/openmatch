$(document).ready(function() {

	$('.hasTooltip').tooltip();

	var alerts = $('div.alert');
	var i = 0;
	$.each( alerts, function($) {
		var temp = alerts.eq(i);
		i++;
		setTimeout(function() {
			temp.fadeOut(1000, function(){
				temp.remove();
			})
		}, 5000);
	});
	

	var path = location.pathname.split("/");
	// window.BASE = "http://dev.openmatch/";
	if(location.hostname.indexOf("127.0.0.1") !== -1 || location.hostname.indexOf("localhost") !== -1){
		window.BASE = "http://"+ location.hostname + "/" + path[1] + "/" + path[2] + "/";
	} else {
		window.BASE = "http://"+ location.hostname + "/";
	}
	//window.BASE = "http://rotterdamonbeperkt.nl/";
	window.IMGLOC = BASE + "img/";

	$('#reactionText').keyup(function(){
		if($(this).val()){
			if(!$('#place').hasClass('clickable')){
				$('#place').addClass('clickable');
			}	
		} else{
			if($('#place').hasClass('clickable')){
				$('#place').removeClass('clickable');
			}	
		}
	});

	$('.ratingHolder > .icon-thumbs-up, .ratingHolder > .icon-thumbs-down').click(function(){ 
		reactionOn = "locations";
		reactionId = $(this).parent().parent().attr('id').substr(8);
		dit = $(this);
		if(dit.hasClass('icon-thumbs-up')){
			type = 'plus';
		}else{
			type = 'min';
		}

		url = window.BASE + "locations/thumb_reaction/"; /*;http://localhost/openmatch/public/location/give_rating*/

		var request = $.ajax({
			url: url,
			type: "POST",
			data: {reactionOn : reactionOn, reactionId : reactionId, type : type},
			dataType: "html"
		});

		request.done(function(msg) {
			if(dit.hasClass('clicked')){
				if(type == 'plus'){
					newVal = dit.parent().parent().children('.ratings').children('.greenIcon').children('span').html();
					newVal--;
					dit.parent().parent().children('.ratings').children('.greenIcon').children('span').html( newVal );
				}else{
					newVal = dit.parent().parent().children('.ratings').children('.redIcon').children('span').html();
					newVal--;
					dit.parent().parent().children('.ratings').children('.redIcon').children('span').html( newVal );
				}
				dit.removeClass('clicked');
			}else{
				if(type == 'plus'){
					if(dit.parent().children('.icon-thumbs-down').hasClass('clicked')){
						newVal = dit.parent().parent().children('.ratings').children('.greenIcon').children('span').html();
						newVal++;
						dit.parent().parent().children('.ratings').children('.greenIcon').children('span').html( newVal );
						newVal = dit.parent().parent().children('.ratings').children('.redIcon').children('span').html();
						newVal--;
						dit.parent().parent().children('.ratings').children('.redIcon').children('span').html( newVal );
					}else{
						newVal = dit.parent().parent().children('.ratings').children('.greenIcon').children('span').html();
						newVal++;
						dit.parent().parent().children('.ratings').children('.greenIcon').children('span').html( newVal );
					}
				}else{
					if(dit.parent().children('.icon-thumbs-up').hasClass('clicked')){
						newVal = dit.parent().parent().children('.ratings').children('.greenIcon').children('span').html();
						newVal--;
						dit.parent().parent().children('.ratings').children('.greenIcon').children('span').html( newVal );
						newVal = dit.parent().parent().children('.ratings').children('.redIcon').children('span').html();
						newVal++;
						dit.parent().parent().children('.ratings').children('.redIcon').children('span').html( newVal );
					}else{
						newVal = dit.parent().parent().children('.ratings').children('.redIcon').children('span').html();
						newVal++;
						dit.parent().parent().children('.ratings').children('.redIcon').children('span').html( newVal );
					}
				}
				dit.parent().children().removeClass('clicked');
				dit.addClass('clicked');
			}
		});

		request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
		});
	});

	$('#place').click(function(){
		if($('#reactionText').val()){
			reactionOn = "locations";
			id = $('img#location-marker-img').data('id');
			reaction = $('#reactionText').val();

			url = window.BASE + "locations/give_reaction/"; /*;http://localhost/openmatch/public/location/give_rating*/
		

			var request = $.ajax({
				url: url,
				type: "POST",
				data: {reactionOn : reactionOn, id: id, reaction : reaction},
				dataType: "html"
			});

			request.done(function(msg) {
				if(msg != 0){
					$('li.last').before(msg);
					$('#reactionText').val('');
				}else{
					alert('Er is iets fout gegaan met het plaatsen van de reactie. Probeer het opnieuw');
				}
			});

			request.fail(function(jqXHR, textStatus) {
				alert( "Request failed: " + textStatus );
			});
		}
	});

	$('.comments').on({
		click: function(){
			theLi = $(this).parent().parent();
			if(theLi.children('p').length > 0){
				text = theLi.children('p').html();
				theLi.children('p').replaceWith('<textarea>'+text);
				theLi.children('textarea').after('<input class="btn clickable editReaction" type="button" value="Aanpassen">');
				theLi.css('padding-bottom', '18px');
			}
		}
	}, "span.edit");

	$('.comments').on({
		click: function(){
			deleteLi = $(this).parent().parent();
			reactionId = $(this).parent().parent().attr('id').substr(8);
			url = window.BASE + "/locations/delete_reaction/";
			reactionOn = "locations";

			
			var request = $.ajax({
				url: url,
				type: "POST",
				data: {reactionOn : reactionOn, reactionId : reactionId},
				dataType: "html"
			});

			request.done(function(msg) {

				deleteLi.remove();
			});

			request.fail(function(jqXHR, textStatus) {
				alert( "Request failed: " + textStatus );
			});
		}
	}, "span.delete");

	$('.comments').on({
		click: function(){
			reaction = $(this).parent().children('textarea').val();

			if(reaction){
				replace = $(this).parent();
				reactionOn = "locations";
				id = $('img#location-marker-img').data('id');
				reactionId = $(this).parent().attr('id').substr(8);
				url = window.BASE + "/update_reaction/"; 

				var request = $.ajax({
					url: url,
					type: "POST",
					data: {reactionOn : reactionOn, id: id, reaction : reaction, reactionId : reactionId},
					dataType: "html"
				});

				request.done(function(msg) {
					if(msg != 0){
						replace.replaceWith(msg);
					}else{
						alert('Er is iets fout gegaan met het aanpassen van de reactie. Probeer het opnieuw');
					}
				});

				request.fail(function(jqXHR, textStatus) {
					alert( "Request failed: " + textStatus );
				});
			}
		}
	}, '.editReaction');

});