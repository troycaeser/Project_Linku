<?php

$reqUrl = $_POST['input_url'];

if($reqUrl){
	$html = sendToJS($reqUrl);

	echo $html;
}

function sendToJS($url){
	$html=file_get_contents($url);

	return $html;
}

?>