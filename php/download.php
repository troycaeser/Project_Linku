<?php
	require 'resize.php';
	require 'manifest.php';

	//The json data sent from main.js
	$request_data = $_POST['ob_data'];
	// $request = json_encode($ob_data);

	$reqUrl = $request_data['url'];
	$final = substr(strstr($reqUrl,'au/'), 3);

	// foreach($request_data as $key => $value){
	// 	echo $request_data['bed_no'];
	// 	// echo $value->['bath_no'];
	// }

	// print_r($request_data->bed_no);

	//crawled variables
	$bed_no = $request_data['bed_no'];
	$bath_no = $request_data['bath_no'];
	$car_no = $request_data['car_no'];
	$auction_time = $request_data['auction'];
	$auction_date = $request_data['auction_date'];

	$data[0] = $bed_no;
	$data[1] = $bath_no;
	$data[2] = $car_no;
	$data[3] = $auction_time;
	$data[4] = $auction_date;

	for($i = 1; $i<=count($request_data['links']); $i++){
		$url = $request_data['links'][$i];

		download_img($url, $final, $i, $data);
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