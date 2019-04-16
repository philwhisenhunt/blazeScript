<?php
require 'queueUp.php';

$array_of_passwords = ['one', 'two', 'three', 'four', 'five'];



$answer = queueUp($array_of_passwords);

print_r($answer);

