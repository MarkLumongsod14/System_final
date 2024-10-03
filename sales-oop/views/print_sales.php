<?php 
$host = 'localhost';
$db = 'I_sales_oop'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all sales data
    $stmt = $pdo->query("SELECT date, amount FROM sales ORDER BY date DESC");
    $salesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Data - Mhare Taste</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
        }
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
            overflow-y: auto;
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
            width: calc(100% - 250px);
        }
        h1 {
            color: #3498db; /* Primary Color */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            animation: fadeIn 0.5s ease-in-out;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #3498db; /* Primary Color */
            color: white;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .message {
            color: green;
            margin: 10px 0;
        }
        .back-button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #1abc9c; /* Soft Green */
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .back-button:hover {
            background-color: #16a085; /* Darker Green */
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Stock Monitor</h2>
        <a href="../views/dashboard.php"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
        <a href="../views/product_list.php"><i class="fa-solid fa-box me-2"></i> Products</a>
        <a href="../views/print_sales.php"><i class="fa-solid fa-file-invoice-dollar me-2"></i> Sales</a>
        <a href="../views/reports.php"><i class="fa-solid fa-chart-line me-2"></i> Reports</a>
     
        <a href="../actions/logout.php" class="btn btn-outline">Logout</a>
    </div>

    <div class="content">
        <h1>Sales Data - Mhare Taste</h1>

        <?php if (count($salesData) > 0): ?>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
                <?php foreach ($salesData as $sale): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sale['date']); ?></td>
                        <td>₱<?php echo number_format($sale['amount'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p class="message">No sales data found.</p>
        <?php endif; ?>

        <a href="../views/dashboard.php" class="back-button"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
    </div>

</body>
</html>
