<!-- File: index.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Denial of Service Endpoint -->
<?php

$NUM_CALC = 900;

function factorial($n){
    if ($n == 0){
        return 1;
    } else {
        return $n * factorial($n-1);
    }
}

$result = factorial($NUM_CALC);
echo "The factorial of ", strval($NUM_CALC), " is ", strval($result);
?>