<?php

//Connect to the database


$host="localhost"; //127.0.0.1
$port=3306;
$socket="";
$user="carlos";
$password="Garage2022";
$dbname="garage";

$conn = mysqli_connect('localhost','carlos', 'Garage2022', 'garage');

//Check the connection

if (!$conn){
echo 'Connection error ' . mysqli_connect_error();
} else{
	echo 'Connection succeed';
}


?>