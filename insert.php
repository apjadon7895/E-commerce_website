<?php

session_start();

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $pin = $_POST["pin"];
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $pwd = password_hash($password, PASSWORD_DEFAULT);
    $re_pwd = $_POST["re_pwd"];
    $verify_token = md5(uniqid());
   

    if ($password !== $re_pwd) {
        echo "Passwords do not match. Please try again.";
    } else {
        // Check if the email already exists in the database
        $check_query = "SELECT * FROM users WHERE email = '$email'";
        $check_result = mysqli_query($mysqli, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo "User already registered. Please log in.";
        } else {
            $sql = "INSERT INTO users (fname, lname, address, city, pin, email, password, verify_token) 
            VALUES('$fname', '$lname', '$address', '$city', '$pin', '$email', '$pwd', '$verify_token')";

            if (!mysqli_query($mysqli, $sql)) {
                die("Error: " . mysqli_error($mysqli));
            } else {
                sendemail_verify($fname, $email, $verify_token);
                $_SESSION['status'] = "Registration is success. Please verify your email address.";
                header("Location:verify-email.php");
                exit();
            }
        }
    }
}

function sendemail_verify($fname, $email, $verify_token) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'apjadon7895@gmail.com';
        $mail->Password = 'ylxu spuk qfym lwms';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('apjadon7895@gmail.com', 'Ap Singh');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email verification from Ap Singh';

        $email_template = "
            <h2>You have Registered with Style BAZAAR</h2>
            <h5>Verify your email address to Login with the below given link</h5>
            <br/><br/>
            <a href='https://astrictechnology.tech//verify-email.php?token=$verify_token'> Click Me </a>";

        $mail->Body = $email_template;
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
