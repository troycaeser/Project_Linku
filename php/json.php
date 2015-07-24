<?php
// require 'main.php';
$reqUrl = $_POST['input_url'];

if($reqUrl){
	$html = sendToJS($reqUrl);

	echo $html;
}

	// this needs to be used somehow
	// checkCrawled();

function sendToJS($url){
	$html=file_get_contents($url);

	return $html;
}

function checkCrawled(){
	$bed_no = $_POST['bed_no'];
	$bath_no = $_POST['bath_no'];
	$car_no = $_POST['car_no'];
	$ppt_price = $_POST['ppt_price'];
	$street = $_POST['street'];
	$suburb = $_POST['suburb'];
	$agency = $_POST['agency'];
	$auction = $_POST['auction'];

	echo "bed number: ".$bed_no;
	echo "auction time: ".$auction;
}

?>