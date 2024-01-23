<?php
//Connection parameters
$servername = 'localhost';
$username = 'root';
$userpwd = '';
$dbname = 'asg 1';

//Create connection
$conn = new mysqli($servername,$username,$userpwd,$dbname);

//Check connection
if($conn->connect_error){
    die("Connection failed:". $conn->connect_error);
}
?>