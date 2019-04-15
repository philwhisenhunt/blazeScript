<?php
$url = 'http://127.0.0.1:8888/wp-login.php';

$ch1 = curl_init($url);
$ch2 = curl_init($url);

//create the curl handle
$mh = curl_multi_init();

//add the handles
curl_multi_add_handle($mh, $ch1);
curl_multi_add_handle($mh, $ch2);


do{
    //multi_exec is the part that is returning something 
    $content = curl_multi_exec($mh, $active);
    if($active){
        curl_multi_select($mh);
    }
} while ($active);


//$content = curl_exec( $ch );
//$header['content'] = $content;
// return $header;

curl_multi_remove_handle($mh, $ch1);
curl_multi_remove_handle($mh, $ch2);
curl_multi_close($mh);


//receive an array of ten items
/*
for each thing in that array, go through the process of initalizing the curl request.
Then, do a multi_curl request to 127.0.0.1

*/