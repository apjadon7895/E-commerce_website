<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect or handle unauthorized access
}
?>

<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information Form</title>

        <!-- CKEditor -->
 <script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>

    <style>
        .productheading{
            margin-top:120px;
            
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="productheading text-center">Product Information</h2>
                <form action="/submit-product" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name:</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>

                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image:</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="productCode" class="form-label">Product Code:</label>
                        <input type="text" class="form-control" id="productCode" name="productCode" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="unitAvailable" class="form-label">Product Unit Available:</label>
                        <input type="number" class="form-control" id="unitAvailable" name="unitAvailable" required>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
            <script>
               CKEDITOR.replace( 'description', { 
                   enterMode : CKEDITOR.ENTER_BR,
                   shiftEnterMode: CKEDITOR.ENTER_P
               } );
               </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include 'admin_dashboard.php'; ?>
