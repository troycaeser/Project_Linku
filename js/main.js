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

				getHTML(input, obj_links, input);
			})
			.done(function(data){
				console.info('links completed');
			});
	});

	function setJson(obj_links, input_url){
		var bed = $('.rui-icon-bed').next().text();
		var bath = $('.rui-icon-bath').next().text();
		var car = $('.rui-icon-car').next().text();
		var price = $('.price').children().first().text();
		var streetAddress = $("span[itemprop='streetAddress']").text();

		//addressLocality needs to be capital
		var addressLocality = $("span[itemprop='addressLocality']").text();

		var agent = $('.agencyName').text();
		var agent_name = $('#agentContactInfo').children().first().text();

		var auction_date = $('.auctionDetails').children().text();
		var auction_time = auction_date.substring(9, auction_date.indexOf("Save"));

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

		console.log(json_data);
		// console.log(agent_name);

		getJson(json_data);
	}
	
	function getJson(json){
		$.post("php/download.php", json)
			.then(function(data){
				console.log(data);
		});
	}

	function getHTML(input, obj_links, input_url){
		$.post("php/json.php",
		{
			input_url: input
		})
		.then(function(data){
			try{
				$('.temporary_output').html(data);
			}catch(e){
				console.error(e);
			}
			finally{
				setJson(obj_links, input_url);

				$('.temporary_output').children().remove();
			}
		});
	}
});