<?php
	include 'resize-class.php';

	function resize_img($path, $name, $dir, $bed_no, $bath_no, $car_no, $auction_time){
		
		//The file
		// $filename = $path;

		//resize
		$resizeObj = new resize($path);
		$resizeObj -> resizeImage(400, 300, 'exact', $name);
		$resizeObj -> saveImage('../temp/'.$dir."/".$name.'.jpg', 100);

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
				'../temp/'.$dir."/".$name.'.jpg');
		}
		else{
			// add watermark.
			$resizeObj -> secondaryImageManipulate('../bin/chisholm_gamon/logo.png','../temp/'.$dir."/".$name.'.jpg');
		}
	}
?>