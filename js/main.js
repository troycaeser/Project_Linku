$(document).ready(function(){

	//send things into main.php
	$('#submit1').click(function(){
		var input = $('#input_url').val();

		$.post("php/main.php", 
			{
				input_url: input
			})
			.then(function(data){
				try{
					$('.temporary_output').html(data)
				}finally{
					setJson();

					$('.temporary_output').children().remove();
				}
			})
			.done(function(data){
				console.log('done');
			});
	});

	function setJson(){
		var bed = $('.rui-icon-bed').next().text();
		var bath = $('.rui-icon-bath').next().text();
		var car = $('.rui-icon-car').next().text();
		var price = $('.price').children().first().text();
		var streetAddress = $("span[itemprop='streetAddress']").text();

		//addressLocality needs to be capital
		var addressLocality = $("span[itemprop='addressLocality']").text();

		var agent = $('.agencyName').text();

		var auction_date = $('.auctionDetails').children().text();
		var auction_time = auction_date.substring(9, auction_date.indexOf("Save"));

		var json_data = {
			bed_no: bed,
			bath_no: bath,
			car_no: car,
			ppt_price: price,
			street: streetAddress,
			suburb: addressLocality,
			agency: agent,
			auction: auction_time
		}

		console.log(json_data);

		getJson(json_data);
	}
	
	function getJson(json){
		$.post("php/main.php", json)
			.done(function(data){
				console.log(data);
		});
	}
});