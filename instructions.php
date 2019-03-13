<?php

//write a script or program to brute force a wordpress site.
//end goal - brute force
//see how far you can get without looking up the answer. 

//going to need a bunch of things to do this.
//would take John an hour
//make program dynamic enough to read in from a txt file
//google most common passwords
//massive text files that you can download.
//how to make a program extensable
//going for admin accounts
// as soon as it finds the right one
//make own site locally with wordpress.
//set it to something you know, and include it in the dictionary so you know that it works. 
//invetigate how to run this without 
//curl and then look for the element that indicates a successful question
//look up things about curl. 

//break it down

/*
curl a site
search for a certain word
if a certain word stop
else keep going

use a while loop to keep going

first step
read about curl
make a sample text file with the words separated by a space
figure out how to read through txt file with php
*/

function get_web_page( $url )
{
    $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

    $options = array(

        CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
        CURLOPT_POST           =>false,        //set to GET
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
    );

    //initializes curl
    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    
    //Addition
    $addition = " | sed 's/<\/*[^>]*>//g'";


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

$fileHere = fopen("smallList.txt", "r") or die ("Cant open file!");
while(!feof($fileHere)){
    echo fgets($fileHere) ;
}
echo "\n";
fclose($fileHere);
$url = 'https://www.google.com/';
$resultFromCurl = get_web_page( $url );
print_r($resultFromCurl);
echo "And now the piece of the result: " . $resultFromCurl['errno'];

echo "\n";


//if [content] has the word "google" then print "HERE"
//using strpos because we want it to return false
$needle = "beer";
$checker = strpos($resultFromCurl['content'], $needle);
echo "Checker is " . $checker;

if($checker != false){
    echo "Checker is not false";
}
else{
    echo "checker is false.";
}
echo "\n";
