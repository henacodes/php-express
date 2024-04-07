<?php 
$string = "someting/anotherthing/onemorething/:someParam";

// Get the last part of the string after the last '/'
$lastPart = substr(strrchr($string, '/'), 1);

// Check if the last part starts with ':'
if (strpos($lastPart, ':') === 0) {
    echo "The string has the last part parameter.";
} else {
    echo "The string does not have the last part parameter.";
}

