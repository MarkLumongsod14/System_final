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

// Calculate total revenue and orders
$total_revenue = 0;
$total_orders = 0;
$low_stock_count = 0;

foreach ($product_list as $item) {
    $total_revenue += $item['price'] * $item['quantity'];
    if ($item['quantity'] == 0) {
        $low_stock_count++;
    }
    $total_orders++; // Increment for each product
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Monitor</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            background: #f4f7fa; /* Soft Light Background */
            color: #333; /* Dark Text */
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
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
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
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #75c9b7; /* Light Teal */
            color: white;
        }
        .content {
            margin-left: 270px;
            padding: 50px;
        }
        /* Dashboard Card Styling */
        .dashboard-card {
            background: #ffffff; /* White Cards */
            border: none;
            color: #4b79a1;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
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
        /* Modal Styling */
        .modal-header {
            background-color: #4b79a1;
            color: white;
        }
        .modal-body {
            background-color: #f9f9f9;
        }
        .form-control {
            border: 1px solid #4b79a1; /* Soft Blue */
        }
        .form-control:focus {
            border-color: #75c9b7; /* Light Teal */
            box-shadow: 0 0 5px rgba(117, 201, 183, 0.5);
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>Stock Monitor</h2>
        <a href="../views/dashboard.php"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
        <a href="../views/product_list.php"><i class="fa-solid fa-box me-2"></i> Products</a>
        <a href="../views/print_sales.php"><i class="fa-solid fa-file-invoice-dollar me-2"></i> Sales</a>
        <a href="../views/reports.php"><i class="fa-solid fa-chart-line me-2"></i> Reports</a>
     
        <a href="../actions/logout.php" class="btn btn-outline">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1 class="mb-4">Dashboard</h1>

        <!-- Dashboard Metrics -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="dashboard-card p-4 text-center">
                    <h5 class="card-title"><?= date('l') . ', ' . date('d M Y') ?></h5>
                    <h1 class="display-4"><?= date('d') ?></h1>
                </div>
            </div>

            <div class="col-md-4 mb-3">
    <div class="dashboard-card p-4 text-center" style="background-color:#245580;">
        <h5 class="card-title text-white">Expected Total Revenue</h5>
        <h1 class="display-5 text-white" style="font-size: 2.5rem;"><?= number_format($total_revenue, 2) ?></h1>
    </div>
</div>


            <div class="col-md-4 mb-3">
                <div class="dashboard-card p-4 text-center">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text display-4"><?= $total_orders ?></p>
                </div>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="dashboard-card p-4 text-center">
                    <h5 class="card-title">Low Stock</h5>
                    <p class="card-text display-4"><?= $low_stock_count ?></p>
                </div>
            </div>
        </div>

        <!-- ADD PRODUCT MODAL -->
        <div class="modal fade" id="add-product" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title mx-auto text-info fw-bold">
                    <i class="fa-solid fa-box-open me-2"></i> Add New Product
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-5">
                <form action="../actions/product-actions.php" method="post" class="w-75 mx-auto">
                    <!-- Product Name Field -->
                    <div class="mb-4">
                        <label for="product-name" class="form-label text-secondary fw-semibold">Product Name</label>
                        <input type="text" name="product_name" id="product-name" class="form-control" required>
                    </div>

                    <!-- Price and Quantity Fields -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="price" class="form-label text-secondary fw-semibold">Price</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-primary">₱</span>
                                <input type="number" name="price" id="price" class="form-control" aria-label="Price" required min="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label text-secondary fw-semibold">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" required min="0">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom px-5 rounded-pill" name="add_product">
                            <i class="fa-solid fa-plus me-2"></i> Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </div>
</body>
</html>
