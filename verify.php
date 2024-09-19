<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $email = $_POST["email"];
    $password = $_POST["pwd"];

    // Check if the user exists in the database
    $check_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Check if the email is verified
            if ($row['is_verified'] == 1) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                echo "Login successful!";
                header("Location: index.php");
                exit();
            } else {
                echo "Please verify your email address first.";
            }
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "No account found with this email address.";
    }

    $stmt->close();
    $mysqli->close();
}
?>
