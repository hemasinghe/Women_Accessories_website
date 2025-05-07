<?php
// Start session

session_start();

require 'dbconnection.php';
$session_id = session_id();


// Get the product ID and quantity from the form submission
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

if ($product_id > 0 && $quantity > 0) {
    // Check if the product is already in the cart for this session
    $query = "SELECT * FROM cart WHERE session_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $session_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the quantity if the product is already in the cart
        $query = "UPDATE cart SET quantity = quantity + ? WHERE session_id = ? AND product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isi", $quantity, $session_id, $product_id);
        $stmt->execute();
    } else {
        // Insert a new record if the product is not in the cart
        $query = "INSERT INTO cart (session_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sii", $session_id, $product_id, $quantity);
        $stmt->execute();
    }

    // Redirect to the cart page or show the cart (as needed)
    header("Location: cart.php");
    exit();
} else {
    echo "Invalid product ID or quantity.";
    exit();
}
?>
