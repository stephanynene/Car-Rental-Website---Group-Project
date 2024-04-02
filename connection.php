<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elite_cruisers";

//to create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>