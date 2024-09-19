<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assuming you have already connected to your database
include "connect1.php";

// Function to fetch data based on filters
function fetchData($mysqli, $params) {
    // Construct SQL query based on filters
    $sql = "SELECT * FROM data WHERE 1=1";
    $bindTypes = "";
    $paramValues = [];

    // If both end year and sector are provided, combine them as a single filter
    if (isset($params['endYear']) && isset($params['sector'])) {
        $sql .= " AND end_year = ? AND sector = ?";
        $paramValues[] = $params['endYear'];
        $paramValues[] = $params['sector'];
        $bindTypes .= "ss"; // Assuming both end_year and sector are strings
    } else {
        if (isset($params['endYear'])) {
            $sql .= " AND end_year = ?";
            $paramValues[] = $params['endYear'];
            $bindTypes .= "s";
        }
        if (isset($params['sector'])) {
            $sql .= " AND sector = ?";
            $paramValues[] = $params['sector'];
            $bindTypes .= "s";
        }
    }

    // Add other filters if provided
    $filters = ['topics', 'region', 'pestle', 'source', 'swot', 'country', 'city'];
    foreach ($filters as $filter) {
        if (isset($params[$filter])) {
            $sql .= " AND $filter = ?";
            $bindTypes .= "s";
            $paramValues[] = $params[$filter];
        }
    }

    // Prepare and execute the SQL query
    $stmt = $mysqli->prepare($sql);
    if ($stmt === false) {
        die("Error in preparing statement: " . $mysqli->error);
    }
    
    // Bind parameters
    if (!empty($bindTypes)) {
        $stmt->bind_param($bindTypes, ...$paramValues);
    }

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch result rows as an associative array
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Close statement and connection
    $stmt->close();

    return $data;
}

// API endpoint to fetch filtered data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch filter parameters from the query string
    $params = [
        'endYear' => $_GET['endYear'] ?? null,
        'topics' => $_GET['topics'] ?? null,
        'sector' => $_GET['sector'] ?? null,
        'region' => $_GET['region'] ?? null,
        'pestle' => $_GET['pestle'] ?? null,
        'source' => $_GET['source'] ?? null,
        'swot' => $_GET['swot'] ?? null,
        'country' => $_GET['country'] ?? null,
        'city' => $_GET['city'] ?? null
    ];

    // Fetch data based on filters
    $data = fetchData($mysqli, $params);

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch filter parameters from the POST data
    $postData = json_decode(file_get_contents('php://input'), true);

    // Fetch data based on filters
    $data = fetchData($mysqli, $postData);

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Unsupported request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Unsupported request method']);
}

// Handling the cURL request
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
