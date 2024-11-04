<?php

$host = 'localhost';
$username = 'root';
$password = ''; 
$database = 'velvet_vogue'; 

$conn = new mysqli($hsot, $username, $password, $database);

if ($conn -> connect_error) {
    die("Connection failed: " .$conn -> connect_error);
}

echo "Connected Successfully";

$conn -> close();
?>