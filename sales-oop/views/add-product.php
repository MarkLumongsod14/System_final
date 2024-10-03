<?php
session_start();
if(empty($_SESSION)){
    header("location: ../views/");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            background: #f0f2f5; /* Light gray background */
            font-family: 'Poppins', sans-serif;
        }
        /* Navbar Styling */
        .navbar {
            background: #2a3f54; /* Dark Blue Background */
        }
        .navbar-brand i {
            color: #ffffff;
        }
        .nav-link {
            font-size: 1.2em;
        }
        .nav-link i {
            transition: color 0.3s ease;
        }
        .nav-link i:hover {
            color: #ff6b6b; /* Light Red Hover */
        }
        /* Form Container Styling */
        .container {
            max-width: 600px;
            margin-top: 80px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: #2a3f54;
            color: #ffffff;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            padding: 30px;
        }
        .form-label {
            font-weight: 500;
            font-size: 0.9em;
        }
        /* Button Styling */
        .btn-primary {
            background: #1abc9c; /* Soft Green */
            border: none;
            border-radius: 25px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px 15px;
        }
        .btn-primary:hover {
            background: #16a085; /* Darker Green */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container-fluid">
            <a href="dashboard.php" class="navbar-brand ms-3">
                <i class="fa-solid fa-house fa-2x"></i>
            </a>
            <div class="ms-auto me-3 navbar-nav">
                <a href="../actions/logout.php" class="nav-link" title="Logout">
                    <i class="fa-solid fa-right-from-bracket fa-2x text-light"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Add Product Form Container -->
    <div class="container">
        <div class="card border-0 shadow">
            <div class="card-header text-center">
                <h2><i class="fa-solid fa-box-open"></i> Add Product</h2>
            </div>
            <div class="card-body">
                <form action="../actions/product-actions.php" method="post">
                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="product-name" class="form-label text-secondary">Product Name</label>
                        <input type="text" name="product_name" id="product-name" class="form-control" required>
                    </div>

                    <!-- Price and Quantity -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="price" class="form-label text-secondary">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" name="price" id="price" class="form-control" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label text-secondary">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="0" required>
                        </div>
                    </div>

                    <!-- Add Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="add_product">
                            <i class="fa-solid fa-plus me-2"></i> Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
