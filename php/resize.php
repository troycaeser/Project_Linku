<?php
	include 'resize-class.php';

	function resize_img($path, $name, $dir){
		
		//The file
		// $filename = $path;

		$resizeObj = new resize($path);

		$resizeObj -> resizeImage(400, 300, 'exact');

		$resizeObj -> saveImage('../temp/'.$dir."/".$name.'.jpg', 100);

		$resizeObj -> restamp('../bin/chisholm_gamon/logo.jpeg', '../temp/'.$dir."/".$name.'.jpg');
	}
?>