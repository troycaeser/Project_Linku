<?php
	include 'resize-class.php';

	function resize_img($path, $name, $dir){
		
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
			'../temp/'.$dir."/".$name.'.jpg');
	}
?>