<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'config.php'; // Use require_once for mandatory files

    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Prepare SQL statement to prevent SQL injection
        $check_query = "SELECT * FROM admin WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($check_query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        // Execute the statement
        $stmt->execute();
        
        // Get result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Login successful
            $_SESSION['username'] = $username; // Store username in session if needed
            $_SESSION['loggedin'] = true; // Set the loggedin flag
            header("Location: admin_dashboard.php"); // Redirect to the desired page
            exit(); // Make sure to call exit to stop script execution
        } else {
            // Login failed
            echo "Incorrect username or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="login-container">
        <form id="loginForm" action="" method="POST">
            <h2>Admin Login</h2>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <button type="submit">Login</button>
            </div>
            <div class="error-message" id="errorMessage">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && !$result) {
                    echo "Incorrect username or password.";
                }
                ?>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>