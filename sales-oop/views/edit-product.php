<?php
    session_start();
    if(empty($_SESSION)){
        header("location: ../views/");
        exit;
    }

    include "../classes/Product.php";

    $product = new Product;

    $product_details = $product->displaySpecificProduct($_GET['product_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <a href="dashboard.php" class="navbar-brand ms-3">
            <i class="fa-solid fa-house fa-2x text-primary"></i>
        </a>
        <div class="ms-auto me-3 navbar-nav">
            <a href="../actions/logout.php" class="nav-link" title="Logout">
                <i class="fa-solid fa-sign-out-alt fa-2x text-danger"></i>
            </a>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mt-5">
        <div class="card shadow-lg border-0 mx-auto" style="max-width: 600px;">
            <div class="card-header bg-primary text-white text-center py-3">
                <h2 class="mb-0">
                    <i class="fa-solid fa-pen-to-square me-2"></i> Edit Product
                </h2>
            </div>

            <div class="card-body p-5">
                <form action="../actions/product-actions.php?product_id=<?= $product_details['id']?>" method="post">
                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="product-name" class="form-label text-secondary fw-semibold">Product Name</label>
                        <input type="text" name="product_name" id="product-name" class="form-control border-primary" value="<?= $product_details['product_name']?>" required>
                    </div>

                    <!-- Price and Quantity Fields -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="price" class="form-label text-secondary fw-semibold">Price</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-primary">₱</span>
                                <input type="number" name="price" id="price" class="form-control border-primary" value="<?= $product_details['price']?>" required min="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label text-secondary fw-semibold">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control border-primary" value="<?= $product_details['quantity']?>" required min="0">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5 rounded-pill" name="edit_product">
                            <i class="fa-solid fa-save me-2"></i> Save Changes
                        </button>
                    </div>
                </form>
                <div class="text-center">
                    <a href="product_list.php" class="btn btn-outline-secondary rounded-pill">
                        <i class="fa-solid fa-arrow-left me-2"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
