<?php
$array1 =[];

$fileHere = fopen("smallList.txt", "r") or die ("Cant open file!");
while(!feof($fileHere)){

    //put stuff here
    $array1[] = fgets($fileHere);
}
fclose($fileHere);

//print_r($array1);

$chunks = array_chunk($array1, 20);

//print_r($chunks);

foreach($chunks as $i =>$chunkPiece){
    echo '$i is ' . $i . "\n";
    print_r($chunkPiece);
    echo "\n";
}