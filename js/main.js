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
		var auction_date = html.find('.auctionDetails').children().text();


		if(auction_date == ''){
			console.log(auction_time);
		}
		else{
			var auction = auction_date.substring(9, auction_date.indexOf("Save"));
			var auction_regex = /([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?(?:AM|PM)?$/i;
			var auction_extracted = auction_regex.exec(auction)[0];
			var auction_condition = auction_extracted.substr(auction_extracted.indexOf(":") + 1, 2);
			var auction_time;

			if(auction_condition == '00'){
				auction_time = auction_extracted.replace(':00', '').toLowerCase();
				// console.log(auction_time);
			}else{
				auction_time = auction_extracted.toLowerCase();
			}

			// console.log(auction_time);
		}

		var json_data = {
			url: input_url,
			bed_no: bed,
			bath_no: bath,
			car_no: car,
			ppt_price: price,
			street: streetAddress,
			suburb: addressLocality,
			agency: agent,
			auction: auction_time,
			links: obj_links,
			agent_name: agent_name
		}

		// console.log(auction_regex.exec(auction_time)[0]);
		console.log(json_data);
		// console.log(agent_name);

		getJson(json_data);
	}
	
	function getJson(json){
		$.post("php/download.php", json)
			.then(function(data){				
				console.log(data);
				$('.kxhead').remove();
				$('.temporary').remove();
				$('head').children().find('script').remove();
				$('.temporary_output').append("<div class='temporary'></div>");
		});
	}

	function getHTML(input, obj_links){
		$.post("php/json.php",
		{
			input_url: input
		})
		.then(function(data){
			alert("line 101");
			var html = $(data);
			html.find('script').remove();
			setJson(obj_links, input, html);

			// try{
			// 	var stuff = html.find('.rui-icon-bed').next().text();
			// 	console.log(stuff);
			// 	// alert("before html is appended");
			// 	// $('.temporary').html(html);

			// 	//something is wrong here won't append and fucks HTML up bro!
			// 	// alert("after html is appended");
			// }catch(e){
			// 	console.error(e);
			// }
			// finally{
			// 	setJson(obj_links, input, data);
			// 	// $('.temporary').remove();
			// 	// $('.temporary_output').append("<div class='temporary'></div>");
			// }
		});
	}
});