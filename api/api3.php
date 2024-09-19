<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect1.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON data received from the client
    $postData = json_decode(file_get_contents('php://input'), true);

    // Check if the JSON decoding was successful
    if ($postData === null && json_last_error() !== JSON_ERROR_NONE) {
        // Handle JSON decoding error
        echo json_encode(array('error' => 'Error decoding JSON data'));
        exit;
    }

    // Check if required parameters are present
    if (!isset($postData['endYear']) || !isset($postData['sector'])) {
        echo json_encode(array('error' => 'Missing parameters'));
        exit;
    }

    // Sanitize input parameters
    $endYear = $postData['endYear'];
    $sectors = $postData['sector']; // Assuming an array of sectors is sent

    // Construct SQL query based on filters
    $sql = "SELECT *
            FROM data
            WHERE end_year = $endYear AND (";

    // Adding conditions for each sector
    foreach ($sectors as $sector) {
        // Escape and quote the sector value
        $escapedSector = $mysqli->real_escape_string($sector);
        $sql .= "sector = '$escapedSector' OR ";
    }
    // Remove the last ' OR ' from the query
    $sql = rtrim($sql, ' OR ');

    $sql .= ");";

    $data = $mysqli->query($sql);
    // Fetch data and store in an array
    $data1 = array();
    while ($row = $data->fetch_assoc()) {
        $data1[] = $row;
    }

    $mysqli->close();

    // Return the data as JSON response
    echo json_encode($data1);
}
?>
