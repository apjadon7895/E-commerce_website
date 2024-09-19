<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch product details for deletion
    $sql_select = "SELECT * FROM products WHERE id = ?";
    $stmt_select = $pdo->prepare($sql_select);
    $stmt_select->execute([$id]);
    $product = $stmt_select->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Delete product image from directory
        $image_path = "../images/" . $product['product_img_name'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete product record from database
        $sql_delete = "DELETE FROM products WHERE id = ?";
        $stmt_delete = $pdo->prepare($sql_delete);
        $stmt_delete->execute([$id]);

        $_SESSION['msg'] = "<div class='alert alert-success'>Product deleted successfully.</div>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Product not found.</div>";
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>No product ID provided.</div>";
}

header('Location: manage-product.php');
exit;
?>
