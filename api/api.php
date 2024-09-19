<?php 
include "connect1.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$query="SELECT * FROM `user` ";
$result=$con->query($query);
if(!$result){
    echo"query not executed ";
}
else {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            print_r($row); // Print each row
        }
    } else {
        echo "No results found.";
    }
}




?>