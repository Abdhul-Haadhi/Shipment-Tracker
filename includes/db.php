<?php

// ------------------Database connection------------------

$host = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'shipment_trackerdb';


$conn = new mysqli($host,$userName,$password,$dbName);

if($conn->connect_error){
    echo "Failed to connect DB".$conn->connect_error;
}


?>