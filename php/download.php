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
	$auction_date = $_POST['auction_date'];

	$data[0] = $bed_no;
	$data[1] = $bath_no;
	$data[2] = $car_no;
	$data[3] = $auction_time;
	$data[4] = $auction_date;

	for($i = 1; $i<=count($_POST['links']); $i++){
		$url = $_POST['links'][$i];

		download_img(
			$url,
			$final,
			$i,
			$data
		);
	}

	function download_img($url, $dir, $name, $data){

		//get the file
		$content = file_get_contents($url);

		$bed_num = $data[0];
		$bath_num = $data[1];
		$car_num = $data[2];
		$auction_time = $data[3];
		$auction_date = $data[4];

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
			$auction_time,
			$auction_date
		);
	}

?>