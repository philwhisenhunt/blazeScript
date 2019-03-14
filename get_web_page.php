<?php

function get_web_page( $url, $username, $password )
{
    //Set the browser
    $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

    //Once logged in, WP will redirect to this url
    $redirect = 'http://localhost:8888/wp-admin/';

    

    $options = array(

        CURLOPT_CUSTOMREQUEST  =>"POST",        //set request type post or get
        CURLOPT_POST           =>true,        //set to POST
        CURLOPT_USERAGENT      => $user_agent, //set user agent
        CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
        CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        //CURLOPT_USERPWD        => $username . ":" . $password
        //CURLOPT_POSTFIELDS     => array("log"=>$username, "pwd"=>$password),
        
        //sets log and pwd, and includes the redirect to get through the hurdles to login to wordpress. Puts everything in the post fields.
        CURLOPT_POSTFIELDS =>'log='.urlencode($username).'&pwd='.urlencode($password).'&redirect_to='.urlencode($redirect)
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