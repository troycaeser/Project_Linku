<?php
	require 'resize.php';
	include 'main.php';
	// download_img($final, $name, $i);

	// $decoded_json = json_decode($_POST['links']);
	// $stuff = json_decode($_POST['links']);
	// echo $_POST['links'][3];
	$url;

	for($i = 1; $i<=count($_POST['links']); $i++){
		$url = $_POST['links'][$i];
		// echo $url;

		download_img($url, $folder_name, $i);
	}

	// function download_img($url, $name){

	// 	//get the file
	// 	$content = file_get_contents($url);

	// 	//save locally
	// 	$fp = fopen("../temp/blah/".$name.".jpg", 'wb');
	// 	fwrite($fp, $content);
	// 	fclose($fp);

	// 	resize_img("../temp/blah/".$name.".jpg", $name);
	// }

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