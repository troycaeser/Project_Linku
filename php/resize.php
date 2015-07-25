<?php
	include 'resize-class.php';

	function resize_img($path, $name, $dir, $bed_no, $bath_no, $car_no){
		
		//The file
		// $filename = $path;

		//resize
		$resizeObj = new resize($path);
		$resizeObj -> resizeImage(400, 300, 'exact');
		$resizeObj -> saveImage('../temp/'.$dir."/".$name.'.jpg', 100);

		//add watermark.
		$resizeObj -> addWatermarks(
			'../bin/chisholm_gamon/logo.png',
			'../bin/chisholm_gamon/bottom.jpeg',
			'../bin/chisholm_gamon/bed.png',
			$bed_no,
			'../bin/chisholm_gamon/bath.png',
			$bath_no,
			'../bin/chisholm_gamon/car.png',
			$car_no,
			'../temp/'.$dir."/".$name.'.jpg');
	}
?>