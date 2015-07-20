<?php

	function download_img($url, $name){
		//get the file
		$content = file_get_contents($url);

		//save locally
		$fp = fopen("../temp/".$name.".jpg", 'wb');
		fwrite($fp, $content);
		fclose($fp);
	}

?>