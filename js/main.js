$(document).ready(function(){


	$('#submit1').click(function(){
		var input = $('#input_url').val();

		$.post("php/main.php", 
			{
				asdf: input
			})
			.done(function(data){
				try{
					$('.stuff').html(data)
				}catch(e){
					var thing = $('.rui-icon-bath').next().text();
					console.log(thing);
				}		
		});
	});
	
});