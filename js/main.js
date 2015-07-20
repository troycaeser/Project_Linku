$(document).ready(function(){


	$('#submit1').click(function(){
		var input = $('#input_url').val();

		$.post("php/main.php", 
			{
				input_url: input
			})
			.done(function(data){
				try{
					$('.temporary_output').html(data)
				}catch(e){
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

					var stuff = {
						bed_no: bed,
						bath_no: bath,
						car_no: car,
						ppt_price: price,
						street: streetAddress,
						suburb: addressLocality,
						agency: agent,
						auction: auction_time
					}

					console.log(agent);
					console.log(stuff);
				}
		});
	});
	
});