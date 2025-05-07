<?php
// Database connection
require 'dbconnection.php';
// Get the product ID from the URL parameter
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Prepare the SQL query to fetch product details based on product ID
$sql = "SELECT product_name, price, image_url, description, item_type, stock_quantity FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the product was found
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    // Handle the case where no product was found
    echo "Product not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sparkle Rose Pendant Necklace</title>
<link rel="stylesheet" type="text/css" href="webstyle.css">

<!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</style>
</head>

<body>
<?php include('header.html');?>

<div class="description">
<table border="0" align=left>
<tr>
<td><img src="<?php echo 'images/'.$product['image_url']; ?>" height="750px" width="600px">
</td>
<td>
<h1><?php echo $product['product_name']; ?></h1>
<br/>
<b>Rs.<?php echo number_format($product['price'], 2); ?></b>
<br/>
<br/>
<hr>
<br/>
<p><b>DESCRIPTION</b></p>
<p><?php echo $product['description']; ?></p>
<br/>
<p>Availability: <?php echo $product['stock_quantity'] > 0 ? 'In Stock' : 'Out of Stock'; ?></p>
<hr>
<br/>
 <!-- Add to Cart Form -->
        <form id="add-to-cart-form" action="add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $product['stock_quantity']; ?>" required>
			<input type="button" value="ADD TO BAG" onclick="submitForm()" >
        </form>

</td>
</tr>
</table>
</div>

<script>
        function submitForm() {
            // JavaScript to submit the form when the button is clicked
            document.getElementById('add-to-cart-form').submit();
        }
    </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>