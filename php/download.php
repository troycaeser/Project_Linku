<?php
	require 'resize.php';

	$url;
	$reqUrl = $_POST['url'];
	$final = substr(strstr($reqUrl,'au/'),3);

	//crawled variables
	$bed_no = $_POST['bed_no'];
	$bath_no = $_POST['bath_no'];
	$car_no = $_POST['car_no'];
	$auction_time = $_POST['auction'];

	for($i = 1; $i<=count($_POST['links']); $i++){
		$url = $_POST['links'][$i];

		download_img(
			$url,
			$final,
			$i,
			$bed_no,
			$bath_no,
			$car_no,
			$auction_time
		);
	}

	function download_img($url, $dir, $name, $bed_num, $bath_num, $car_num, $auction_time){

		//get the file
		$content = file_get_contents($url);

		//save locally
		$fp = fopen("../temp/".$dir."/".$name.".jpg", 'wb');
		fwrite($fp, $content);
		fclose($fp);

		resize_img(
			"../temp/".$dir."/".$name.".jpg",
			$name,
			$dir,
			$bed_num,
			$bath_num,
			$car_num,
			$auction_time
		);
	}

?>