<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'dbconnection.php'; // Include the database connection

// Get the session ID
$session_id = session_id();

// Collect form data
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
$total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : 0;

if ($name && $email && $address && $payment_method && $total_amount > 0) {
    // Insert order details into the database
    $order_query = "INSERT INTO orders (session_id, name, email, address, payment_method, total_amount) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($order_query);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sssssd", $session_id, $name, $email, $address, $payment_method, $total_amount);
    $stmt->execute();

    // Get the order ID
    $order_id = $stmt->insert_id;

    // Transfer cart items to order_items table (if you have this setup)
    $cart_query = "SELECT product_id, quantity FROM cart WHERE session_id = ?";
    $stmt = $conn->prepare($cart_query);
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $cart_result = $stmt->get_result();

    while ($cart_item = $cart_result->fetch_assoc()) {
        $item_query = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($item_query);
        $stmt->bind_param("iii", $order_id, $cart_item['product_id'], $cart_item['quantity']);
        $stmt->execute();
    }

    // Clear the cart
    $clear_cart_query = "DELETE FROM cart WHERE session_id = ?";
    $stmt = $conn->prepare($clear_cart_query);
    $stmt->bind_param("s", $session_id);
    $stmt->execute();

    // Show a confirmation message
	
	echo"<link rel='stylesheet' href='confirmation.css'>";
	echo"<div class='container'>";
    echo "<h2>Thank you for your order! </h2>";
    echo "<p>Your order has been successfully placed.</p>";
	echo "<p>Your order number is: #" . $order_id . "</p>";
    echo "<p>Total amount: $" . number_format($total_amount, 2) . "</p>";
    echo "<p>We will send a confirmation to your email: " . htmlspecialchars($email) . "</p>";
    echo "<p>Payment Method: " . htmlspecialchars(ucwords(str_replace('_', ' ', $payment_method))) . "</p>";
    echo"</div>";
} else {
    echo "There was an issue with your order. Please try again.";
}
?>
