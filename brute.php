<?php

$username = "admin";
$password = "password";

function get_web_page( $url )
{
    $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
    

    $options = array(

        CURLOPT_CUSTOMREQUEST  =>"POST",        //set request type post or get
        CURLOPT_POST           =>true,        //set to GET
        CURLOPT_USERAGENT      => $user_agent, //set user agent
        //CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
        //CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_USERPWD        => $username . ":" . $password
    );

    //initializes curl
    $ch = curl_init( $url );

    //save this one
    curl_setopt_array( $ch, $options );
    
    //Performs the curl session
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}


$url = 'http://localhost:8888/wp-login.php';
$resultFromCurl = get_web_page( $url );
//print_r($resultFromCurl);


echo "\n";


//if [content] has the word in $needle, then print "HERE"
//using strpos because we want it to return false
$needle = "Lost";
$checker = strpos($resultFromCurl['header'], $needle);
echo "Checker is " . $checker . " ". "\n";

if($checker !== false){
    echo "Checker is not false \n";
  
}
else{
    echo "The needle is not in the haystack";
}
echo "\n";

file_put_contents('results.txt', $resultFromCurl['content']);

echo "----------------------------------";
print_r($resultFromCurl);

$fileHere = fopen("smallList.txt", "r") or die ("Cant open file!");
while(!feof($fileHere)){
    $password = fgets($fileHere);
    //echo "The current password we are trying is ... " . fgets($fileHere);
    echo "The current password we are trying is ... " . $password;
    echo "\n";


    
}
echo "\n";
fclose($fileHere);
