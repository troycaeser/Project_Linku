<?php

	function download_img($url){
		//get the file
		$content = file_get_contents($url);

		//save locally
		$fp = fopen("../temp/1.jpg", 'wb');
		fwrite($fp, $content);
		fclose($fp);
	}

?>