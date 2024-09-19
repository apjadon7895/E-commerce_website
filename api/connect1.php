<?php

$servername = "localhost";
$username = "astricte_shakti";
$password = "Amit@890";
$database = "astricte_api";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// echo "Connected successfully";

// // Close connection
// $mysqli->close();
?>
