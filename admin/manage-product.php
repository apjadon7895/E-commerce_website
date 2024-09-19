<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Check if delete button is clicked
if (isset($_POST['delete'])) {
    // Ensure 'chk' is set before accessing it
    if (isset($_POST['chk'])) {
        $cid = $_POST['chk'];
        foreach ($cid as $v) {
            // Fetch product details for deletion
            $sql_select = "SELECT * FROM products WHERE id = ?";
            $stmt_select = $pdo->prepare($sql_select);  // Use $pdo instead of $conn
            $stmt_select->execute([$v]);
            $row = $stmt_select->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // Delete product image from directory
                $image_path = "../images/" . $row['product_img_name'];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }

                // Delete product record from database
                $sql_delete = "DELETE FROM products WHERE id = ?";
                $stmt_delete = $pdo->prepare($sql_delete);  // Use $pdo instead of $conn
                $stmt_delete->execute([$v]);
            }
        }

        // Set session message after deletion
        $_SESSION['msg'] = "<div class='alert alert-success'>Selected products deleted successfully.</div>";
    } else {
        // Set session message if no product was selected
        $_SESSION['msg'] = "<div class='alert alert-warning'>No product selected for deletion.</div>";
    }
}

// Fetch all products for display
$sql_products = "SELECT * FROM products ORDER BY id DESC";
$stmt_products = $pdo->prepare($sql_products);  // Use $pdo instead of $dsn
$stmt_products->execute();
$products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-heading {
            margin-top: 120px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="product-heading text-center">Manage Products</h2>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <form action="manage-product.php" method="post">
                    <div class="mb-3">
                        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete selected products?')" class="btn btn-danger">Delete Selected</button>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Code</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Description</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                                <th scope="col"><input type="checkbox" class="checkall"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $index => $product) : ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td><?= htmlspecialchars($product['product_code']); ?></td>
                                    <td><?= htmlspecialchars($product['product_name']); ?></td>
                                    <td><img src="../images/<?= htmlspecialchars($product['product_img_name']); ?>" width="100"></td>
                                    <td><?= htmlspecialchars($product['product_desc']); ?></td>
                                    <td><?= htmlspecialchars($product['qty']); ?></td>
                                    <td><?= htmlspecialchars($product['price']); ?></td>
                                    <td>
                                        <a href="edit-product.php?id=<?= $product['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="delete-product.php?id=<?= $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                    <td><input type="checkbox" name="chk[]" value="<?= $product['id']; ?>"></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>