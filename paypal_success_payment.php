<?php

require 'Carbon/autoload.php';

use Carbon\Carbon;

include 'config.php';

session_start();

// $conn = mysqli_connect("localhost", "root", "", "food_db");
# already declare in config.php no need declare one more times at here.

$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];
$email = $_SESSION['user_email'];

$user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'");
while ($user_row = mysqli_fetch_assoc($user)) {
    $number = $user_row['phone_number'];
    $address = $user_row['address'];
}
$method = "paypal";
$placed_on = date('d-M-Y');

$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
if (mysqli_num_rows($cart_query) > 0) {
    while ($cart_item = mysqli_fetch_assoc($cart_query)) {
        $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
        $sub_total = ($cart_item['price'] * $cart_item['quantity']);
        $cart_total += $sub_total;
    }
}

$now = Carbon::now();

$total_products = implode(', ', $cart_products);

$order_code = "ORDER" . date("YmdHis") . "D" . $user_id;

$payment_status = "paid";

mysqli_query($conn, "INSERT INTO `orders`(order_code, user_id, name, number, email, method, address, total_products, total_price, placed_on, payment_status) 
VALUES('$order_code', '$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on', '$payment_status')");

$order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE order_code = '$order_code'");
if (mysqli_num_rows($order_query) > 0) {
    while ($order_row = mysqli_fetch_assoc($order_query)) {
        $order_id = $order_row['id'];
    }
}

$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';

for ($i = 0; $i < 20; $i++) 
{
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
}

$txn_id = $randomString;

mysqli_query($conn, "INSERT INTO `payments`(order_code, txn_id, order_id, total_payment, payment_status, shipping_address, created_at) 
VALUES('$order_code', '$txn_id', '$order_id', '$cart_total', '$payment_status', '$address', '$now')");

$message[] = 'order placed successfully!';
mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
$_SESSION['payment_success'] = 1;
header('location:orders.php');

?>