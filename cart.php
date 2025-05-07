<?php

session_start();
require 'dbconnection.php';
$session_id = session_id();


// Fetch the cart items for the current session
$query = "SELECT c.quantity, p.product_name, p.price, p.image_url FROM cart c JOIN products p ON c.product_id = p.product_id WHERE c.session_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $session_id);
$stmt->execute();
$result = $stmt->get_result();


// Initialize total amount
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style_checkout.css">
</head>
<body>
	<?php include('header.html');?>

    <!-- Cart Section -->
    <div id="cartSection">
        <h2>Your Cart</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
					<th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <img src="<?php echo 'images/'.$row['image_url']; ?>" alt="<?php echo $row['product_name']; ?>" style="width:50px;height:50px;">
                            
                        </td>
						<td><b><?php echo $row['product_name']; ?><b></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>Rs. <?php echo number_format($row['price'], 2); ?></td>
                        <td>Rs. <?php echo number_format($row['price'] * $row['quantity'], 2); ?></td>
                    </tr>
                    <?php $total += $row['price'] * $row['quantity']; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p><strong>Total: Rs. <?php echo number_format($total, 2); ?></strong></p>
		<button id="proceedToCheckout">Proceed to Checkout</button>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
	</div>
	
	<!-- Checkout Form Section -->
    <div id="checkoutSection" class="hidden">
        <h2>Billing Information</h2>
        <form id="checkoutForm" action="process_checkout.php" method="POST">
		<h3>Total Cost: Rs. <span id="checkoutTotalCost"><?php echo number_format($total, 2); ?></span></h3>
            <div>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>
            </div>
            <div>
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="credit-card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank-transfer">Bank Transfer</option>
                </select>
            </div>
			<div>
			  <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
			  </div>
            <input type="button" value="PLACE ORDER" onclick="submitForm()">
        </form>
    </div>
	<script>
	
	document.getElementById("proceedToCheckout").addEventListener("click", () => {
    document.getElementById("cartSection").classList.add("hidden");
    document.getElementById("checkoutSection").classList.remove("hidden");
	});
	
        function submitForm() {
            // JavaScript to submit the form when the button is clicked
            document.getElementById('checkoutForm').submit();
        }
    </script>
	
</body>
</html>
