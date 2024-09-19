<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>

<?php
if (isset($_SESSION['status'])) {
    echo '<p style="color:green;">' . $_SESSION['status'] . '</p>';
    unset($_SESSION['status']); // Clear the status message after displaying
}

if (isset($_SESSION['error'])) {
    echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']); // Clear the error message after displaying
}
?>

<h2>Email Verification</h2>
<p>Please check your email and click on the verification link.</p>

</body>
</html>


<?php
session_start();
include 'config.php'; // Include your database configuration file

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $query = "SELECT * FROM users WHERE verify_token = '$token' LIMIT 1";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if ($row['is_verified'] == 0) {
            // Update user verification status
            $update_query = "UPDATE users SET is_verified = 1, verify_token = NULL WHERE verify_token = '$token'";
            $update_result = mysqli_query($mysqli, $update_query);

            if ($update_result) {
                $_SESSION['status'] = "Your account has been verified successfully!";
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['status'] = "Verification failed. Please try again.";
                header("Location: register.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Email already verified. Please log in.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Invalid token. Please try again.";
        header("Location: register.php");
        exit();
    }
} else {
    $_SESSION['status'] = "No token provided.";
    header("Location: register.php");
    exit();
}
?>


