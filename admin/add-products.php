<?php
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('config.php'); // Include your database configuration file
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Check if the admin session is set
    // if (!isset($_SESSION['admin'])) {
    //     // Redirect or show an error message if not logged in
    //     $_SESSION['msg1'] = "<h4><strong>Error!</strong> You are not authorized to access this page.</h4>";
    //     header('Location: login.php'); // Redirect to login page
    //     exit();
    // }

    // Initialize variables
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];

    // Image upload handling
    if ($_FILES['productImage']['name']) {
        $img_name = $_FILES['productImage']['name'];
        $tmp_name = $_FILES['productImage']['tmp_name'];
        $path = "../images/";
        $image = uniqid() . '_' . $img_name; // Concatenate with unique ID
        if (!move_uploaded_file($tmp_name, $path . $image)) {
            $_SESSION['msg1'] = "<h4><strong>Error!</strong> Failed to upload image.</h4>";
            header('Location: add-products.php');
            exit();
        }
    } else {
        $_SESSION['msg1'] = "<h4><strong>Error!</strong> Product image is required.</h4>";
        header('Location: add-products.php');
        exit();
    }

    // Insert into database using PDO
    try {
        $sql = "INSERT INTO products (product_code, product_name, product_desc, qty, price, product_img_name)
                VALUES (:product_code, :product_name, :product_desc, :qty, :price, :product_img_name)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':product_code' => $product_code,
            ':product_name' => $product_name,
            ':product_desc' => $product_desc,
            ':qty' => $qty,
            ':price' => $price,
            ':product_img_name' => $image
        ]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['msg1'] = "<h4><strong>Success!</strong> Product added successfully.</h4>";
        } else {
            $_SESSION['msg1'] = "<h4><strong>Error!</strong> Failed to add product.</h4>";
        }
    } catch (PDOException $e) {
        $_SESSION['msg1'] = "<h4><strong>Error!</strong> " . $e->getMessage() . "</h4>";
    }

    header('Location: add-products.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <style>
        .productheading {
            margin-top: 120px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="productheading text-center">Product Information</h2>
                <?php
                if (isset($_SESSION['msg1'])) {
                    echo $_SESSION['msg1'];
                    unset($_SESSION['msg1']); // Clear message after displaying
                }
                ?>
                <form action="add-products.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="product_code" class="form-label">Product Code:</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name:</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image:</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_desc" class="form-label">Product Description:</label>
                        <textarea class="form-control" id="product_desc" name="product_desc" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="qty" class="form-label">Quantity:</label>
                        <input type="number" class="form-control" id="qty" name="qty" required>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- CKEditor initialization script -->
    <script>
        CKEDITOR.replace('product_desc', {
            enterMode: CKEDITOR.ENTER_BR,
            shiftEnterMode: CKEDITOR.ENTER_P
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
