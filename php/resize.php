<?php
	include("resize-class.php");

	function resize_img($path, $name){
		
		//The file
		// $filename = $path;

		$resizeObj = new resize($path);

		$resizeObj -> resizeImage(400, 300, 'exact');

		$resizeObj -> saveImage('../temp/'.$name.'.jpg', 100);

		// //Content type
		// header('Content-Type: image/jpeg');

		// //Get new Dimensions
		// list($width, $height) = getimagesize($filename);
		// $new_height = 300;
		// $new_width = 400;

		// //Resample
		// $image_p = imagecreatetruecolor($new_width, $new_height);
		// $image = imagecreatefromjpeg($filename);
		// imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

		// //Output
		// imagejpeg($image_p, $name , 100);
	}

?>