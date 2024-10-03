<?php

include_once "../classes/Product.php";

$product = new Product;

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $product->addProduct($product_name, $price, $quantity);
} elseif (isset($_POST['edit_product'])) {
    $product_id = $_GET['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $product->editProduct($product_id, $product_name, $price, $quantity);
} elseif (isset($_POST['pay_product'])) {
    $product_id = $_GET['product_id'];
    $buy_quantity = $_POST['buy_quantity'];

    $product->adjustStock($product_id, $buy_quantity);
}