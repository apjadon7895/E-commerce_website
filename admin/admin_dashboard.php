<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: admin_dashboard.php'); // Ensure redirection is to a login page
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
 <header><?php include 'header.php'; ?></header>
<body>
    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="about.php">About</a>
        <a href="account.php">Account</a>
        <a href="contact.php">Contact</a>
       <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        Products
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="add-products.php">Add Product</a></li>
        <li><a class="dropdown-item" href="manage-product.php">Manage Product</a></li>
    </ul>
</div>

    </div>
    <div class="content">
        <h1>This is the admin dashboard.</h1>
        <p>Welcome to your dashboard! Here you can manage your site.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>