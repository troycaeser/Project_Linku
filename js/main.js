$(document).ready(function(){

	//send things into main.php
	$('#submit1').click(function(){
		var input = $('#input_url').val();

		$.post("php/main.php", 
			{
				input_url: input
			})
			.then(function(data){
				var obj_links = {};

				$.each($.parseJSON(data), function(key, value){
					console.log(key + ": " + value);
					obj_links[key] = value;
				});

				getHTML(input, obj_links);
			})
			.done(function(data){
				console.info('links completed');
			});
	});

	function setJson(obj_links, input_url, html){
		// html.find('.rui-icon-bed').next().text();

		var bed = html.find('.rui-icon-bed').next().text();
		var bath = html.find('.rui-icon-bath').next().text();
		var car = html.find('.rui-icon-car').next().text();
		var price = html.find('.price').children().first().text();
		var streetAddress = html.find("span[itemprop='streetAddress']").text();

		//addressLocality needs to be capital
		var addressLocality = html.find("span[itemprop='addressLocality']").text();

		var agent = html.find('.agencyName').text();
		var agent_name = html.find('#agentContactInfo').children().first().text();

		var auction_time = "stuff";
		var auction_string = html.find('.auctionDetails').children().text();
		// console.log('this is auction date bro: ' + auction_string);


		if(auction_string == ''){
			console.log(auction_time);
		}
		else{
			var auction = auction_string.substring(9, auction_string.indexOf("Save"));
			var auction_regex = /([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?(?:AM|PM)?$/i;
			var auction_extracted = auction_regex.exec(auction)[0];
			var auction_condition = auction_extracted.substr(auction_extracted.indexOf(":") + 1, 2);
			var auction_date_min = $.trim(auction_string.substr(auction_string.indexOf(":")+1, 5));
			var auction_date;

			if(auction_date_min == 'Wed'){
				auction_date = 'Wednesday';
			}
			else if(auction_date_min == 'Sat'){
				auction_date = 'Saturday'
			}
			// console.log(auction_date);
			var auction_time;

			if(auction_condition == '00'){
				auction_time = auction_extracted.replace(':00', '').toLowerCase();
				// console.log(auction_time);
			}else{
				auction_time = auction_extracted.toLowerCase();
			}
		}

		var json_data = {
			ob_data: {
				url: input_url,
				bed_no: bed,
				bath_no: bath,
				car_no: car,
				ppt_price: price,
				street: streetAddress,
				suburb: addressLocality,
				agency: agent,
				auction: auction_time,
				auction_date: auction_date,
				links: obj_links,
				agent_name: agent_name
			}
		}

		console.log(json_data);

		getJson(json_data);
	}
	
	function getJson(json){
		$.post("php/download.php", json)
			.then(function(data){				
				console.log(data);
				// $('.kxhead').remove();
				// $('.temporary').remove();
				// $('head').children().find('script').remove();
				// $('.temporary_output').append("<div class='temporary'></div>");
		});
	}

	function getHTML(input, obj_links){
		$.post("php/crawl.php",
		{
			input_url: input
		})
		.then(function(data){
			var html = $(data);
			// html.find('script').remove();
			setJson(obj_links, input, html);
		});
	}
});