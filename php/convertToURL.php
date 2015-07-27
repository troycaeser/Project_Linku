<?php

$rez = google_search_api(array(
    'q' => '3/3 Stradbroke Street Oakleigh South Vic 3167', // 查询内容
    'userip' => '127.0.0.1',
 ));
header('Content-type: text/html; charset=utf-8;');
echo '<xmp>';
print_r($rez);
echo '</xmp>';

function google_search_api($args, $referer = 'http:/www.realestate.com.au/', $endpoint = 'web'){
    $url = "http://ajax.googleapis.com/ajax/services/search/".$endpoint;
    if ( !array_key_exists('v', $args) )
        $args['v'] = '1.0';
    $url .= '?'.http_build_query($args, '', '&');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    $body = curl_exec($ch);
    curl_close($ch);
    return json_decode($body);
}


?>
