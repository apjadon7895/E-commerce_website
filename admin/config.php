// <?php
// $currency = '₹';
// $db_username = 'astricte_shakti';
// $db_password = 'Amit@890';
// $db_name = 'astricte_bolt';
// $db_host = 'localhost';
// $mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);
// ?>


<?php
$currency = '₹';
$db_username = 'astricte_shakti';
$db_password = 'Amit@890';
$db_name = 'astricte_bolt';
$db_host = 'localhost';

try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $pdo = new PDO($dsn, $db_username, $db_password);

    // Set PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   // echo "Connection successful!";
} catch (PDOException $e) {
   // echo "Connection failed: " . $e->getMessage();
}
?>




