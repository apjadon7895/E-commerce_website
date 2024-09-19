<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch product details
    $sql_select = "SELECT * FROM products WHERE id = ?";
    $stmt_select = $pdo->prepare($sql_select);
    $stmt_select->execute([$id]);
    $product = $stmt_select->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Product not found.</div>";
        header('Location: manage-products.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_code = $_POST['product_code'];
        $product_name = $_POST['product_name'];
        $product_desc = $_POST['product_desc'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];
        $product_img_name = $product['product_img_name'];

        // Check if a new image is uploaded
        if (!empty($_FILES['product_img']['name'])) {
            $image_path = "../images/" . $product_img_name;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $product_img_name = basename($_FILES['product_img']['name']);
            $target_file = "../images/" . $product_img_name;
            move_uploaded_file($_FILES['product_img']['tmp_name'], $target_file);
        }

        // Update product details
        $sql_update = "UPDATE products SET product_code = ?, product_name = ?, product_desc = ?, qty = ?, price = ?, product_img_name = ? WHERE id = ?";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([$product_code, $product_name, $product_desc, $qty, $price, $product_img_name, $id]);

        $_SESSION['msg'] = "<div class='alert alert-success'>Product updated successfully.</div>";
        header('Location: manage-product.php');
        exit;
        
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>No product ID provided.</div>";
    header('Location: manage-products.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Edit Product</h2>
                <form action="edit-product.php?id=<?= $id; ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="product_code" class="form-label">Product Code</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" value="<?= htmlspecialchars($product['product_code']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?= htmlspecialchars($product['product_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_desc" class="form-label">Product Description</label>
                        <textarea class="form-control" id="product_desc" name="product_desc" rows="3" required><?= htmlspecialchars($product['product_desc']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" value="<?= htmlspecialchars($product['qty']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_img" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="product_img" name="product_img">
                        <img src="../images/<?= htmlspecialchars($product['product_img_name']); ?>" width="100" class="mt-2">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
