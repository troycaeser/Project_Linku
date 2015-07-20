<?php
	require 'resize.php';

	function download_img($url, $dir, $name){

		//get the file
		$content = file_get_contents($url);

		//save locally
		$fp = fopen("../temp/".$dir."/".$name.".jpg", 'wb');
		fwrite($fp, $content);
		fclose($fp);

		resize_img("../temp/".$dir."/".$name.".jpg", $name, $dir);
	}

?>