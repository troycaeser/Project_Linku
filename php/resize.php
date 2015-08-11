<?php
	include 'resize-class.php';

	function resize_img($path, $name, $dir, $bed_no, $bath_no, $car_no, $auction_time, $auction_date){
		
		//get manifest
		$manifest = json_decode(file_get_contents("../bin/chisholm_gamon/manifest.json"), true);
		$logo_margin_x = $manifest['main']['logo']['margin_x'];
		$logo_margin_y = $manifest['main']['logo']['margin_y'];

		//resize
		$resizeObj = new resize($path);

		if($name == '1'){
			$resizeObj -> resizeImage(400, 300, 'exact', $name);
		}
		else{
			$resizeObj -> resizeImage(400, 269, 'exact', $name);
		}
		$resizeObj -> saveImage('../temp/'.$dir."/".$name.'.jpg', 100);


		//play

		/get agent template manifest
		manipulate
		'../bin/'.data[4].'/manifest.json'






		//




		if($name == '1'){
			// add watermark.
			$resizeObj -> mainImageManipulate(
				'../bin/chisholm_gamon/logo.png',
				'../bin/chisholm_gamon/bottom.jpeg',
				'../bin/chisholm_gamon/bed.png',
				$bed_no,
				'../bin/chisholm_gamon/bath.png',
				$bath_no,
				'../bin/chisholm_gamon/car.png',
				$car_no,
				'../bin/chisholm_gamon/banner.png',
				$auction_time,
				$auction_date,
				$logo_margin_x,
				'../temp/'.$dir."/".$name.'.jpg');
		}
		else{
			// add watermark.
			$resizeObj -> secondaryImageManipulate('../bin/chisholm_gamon/logo.png','../temp/'.$dir."/".$name.'.jpg');
		}
	}
?>