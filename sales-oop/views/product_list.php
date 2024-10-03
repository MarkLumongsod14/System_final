<?php 
session_start();

// Ensure the user is logged in
if(empty($_SESSION)){
    header("location: ../views/");
    exit;
}

// Include the Product class
include "../classes/Product.php";

$product = new Product;

// Fetch all products
$product_list = $product->displayProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            background: #f3f7f9; /* Light Gray Background */
            color: #2d3436; /* Dark Text */
            font-family: 'Poppins', sans-serif;
        }
        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background: #4b79a1; /* Soft Blue */
            color: white;
            padding: 30px 0;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
        }
        .sidebar h2 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: white;
            padding: 15px 30px;
            display: block;
            text-decoration: none;
            font-size: 1.1em;
            transition: background 0.3s, color 0.3s;
        }
        .sidebar a:hover {
            background: #75c9b7; /* Light Teal */
            color: white;
        }
        .content {
            margin-left: 270px;
            padding: 50px;
        }
        /* Table Styling */
        .table thead {
            background: #4b79a1; /* Blue Header */
            color: white;
        }
        .table tbody tr {
            background: #ffffff; /* White Row */
            transition: background 0.3s;
        }
        .table tbody tr:hover {
            background: #e0f7fa; /* Light Cyan Hover */
        }
        /* Button Styling */
        .btn-custom {
            background: #38a1db; /* Calming Sky Blue */
            border: none;
            color: white;
            transition: background 0.3s;
        }
        .btn-custom:hover {
            background: #75c9b7; /* Light Teal */
            color: white;
        }
        .no-records {
            background: #f8d7da; /* Light Red Background */
            border: 1px solid #f5c6cb; /* Light Red Border */
            color: #721c24; /* Dark Red Text */
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>Stock Monitor</h2>
        <a href="../views/dashboard.php"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
        <a href="#"><i class="fa-solid fa-box me-2"></i> Products</a>
        <a href="../views/print_sales.php"><i class="fa-solid fa-file-invoice-dollar me-2"></i> Sales</a>
        <a href="../views/reports.php"><i class="fa-solid fa-chart-line me-2"></i> Reports</a>
        <a href="../actions/logout.php" class="btn btn-outline">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1 class="mb-4">Product List</h1>

        <!-- Products Table -->
        <div class="container mt-5">
            <div class="card w-100 mx-auto shadow-lg border-0" style="max-width: 1200px;">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col text-start">
                            <h1 class="display-6 fw-bold">Product List</h1>
                        </div>
                        <div class="col text-end">
                            <i class="fa-solid fa-plus fa-3x text-info" data-bs-toggle="modal" data-bs-target="#add-product" style="cursor: pointer;"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php
                        if(empty($product_list)){
                    ?>
                        <div class="container-fluid p-5 text-center no-records">
                            <h1 class="display-6 fw-bold pt-5 pb-3">No Records Found</h1>
                            <i class="fa-regular fa-circle-xmark fa-8x pb-5"></i>
                        </div>
                    <?php
                        } else {
                    ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                foreach($product_list as $product){
                            ?>
                                    <tr>
                                        <td><?= $product['id']?></td>
                                        <td><?= $product['product_name']?></td>
                                        <td>₱<?= number_format($product['price'], 2)?></td>
                                        <td><?= $product['quantity']?></td>
                                        <td>
                                            <a href="edit-product.php?product_id=<?= $product['id'] ?>" class="btn btn-sm btn-custom" title="Edit Product"><i class="fa-solid fa-pen"></i></a>
                                            <a href="../actions/delete-product.php?product_id=<?= $product['id'] ?>" class="btn btn-sm btn-danger" title="Delete Product"><i class="fa-solid fa-trash"></i></a>
                                            <a href="buy-product.php?product_id=<?= $product['id'] ?>" class="btn btn-sm btn-success" title="List as Sold"><i class="fa-solid fa-check"></i> </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- ADD PRODUCT MODAL -->
        <div class="modal fade" id="add-product" tabindex="-1" aria-labelledby="registration" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5">
                        <h1 class="display-4 fw-bold text-info text-center"><i class="fa-solid fa-box"></i> Add Product</h1>

                        <form action="../actions/product-actions.php" method="post" class="w-75 mx-auto pt-4">
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label for="product-name" class="form-label small text-secondary">Product Name</label>
                                    <input type="text" name="product_name" id="product-name" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="price" class="form-label small text-secondary">Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="price-tag">₱</span>
                                        <input type="number" name="price" id="price" class="form-control" aria-label="Price" aria-describedby="price-tag" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label small text-secondary">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md">
                                    <button type="submit" class="btn btn-info w-100" name="add_product">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
