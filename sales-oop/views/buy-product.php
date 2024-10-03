<?php
session_start();
if(empty($_SESSION)){
    header("location: ../views/");
    exit;
}

include "../classes/Product.php";

$product = new Product;

// Fetch the specific product details
$product_details = $product->displaySpecificProduct($_GET['product_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List as Sold</title>
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
            <div class="card-header bg-success text-white text-center py-3">
                <h2 class="mb-0">
                    <i class="fa-solid fa-cash-register me-2"></i> List as Sold
                </h2>
            </div>

            <div class="card-body p-5">
                <form action="../views/payment.php?product_id=<?= $product_details['id']?>" method="post">
                    <!-- Product Name Display -->
                    <div class="mb-4 text-center">
                        <label for="product-name" class="form-label text-secondary fw-semibold">Product Name</label>
                        <h2 class="display-6 fw-bold text-dark"><?= $product_details['product_name'] ?></h2>
                    </div>

                    <!-- Price and Quantity Display -->
                    <div class="row mb-4 text-center">
                        <div class="col-md-6">
                            <label for="price" class="form-label text-secondary fw-semibold">Price</label>
                            <h2 class="display-6 fw-bold text-success">₱ <?= number_format($product_details['price'], 2) ?></h2>
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label text-secondary fw-semibold">Stocks Left</label>
                            <h2 class="display-6 fw-bold text-warning"><?= $product_details['quantity'] ?></h2>
                        </div>
                    </div>

                    <!-- Buy Quantity Input -->
                    <div class="mb-4">
                        <label for="buy-quantity" class="form-label text-secondary fw-semibold text-center d-block">Buy Quantity</label>
                        <div class="col-md-8 mx-auto">
                            <input type="number" name="buy_quantity" id="buy-quantity" class="form-control form-control-lg text-center border-success fw-bold" required min="1" max="<?= $product_details['quantity']?>">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-success px-5 rounded-pill" name="buy_product">
                            <i class="fa-solid fa-wave me-2"></i> Mark as Sold
                        </button>
                    </div>
                </form>

                <!-- Back Button -->
                <div class="text-center">
                    <a href="product_list.php" class="btn btn-outline-secondary rounded-pill">
                        <i class="fa-solid fa-arrow-left me-2"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
