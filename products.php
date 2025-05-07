<?php
// Database connection
        require 'dbconnection.php';

		$item_type = isset($_GET['type']) ? $_GET['type'] : '';
        // Query to fetch products
        $sql = "SELECT product_id,product_name, price, image_url FROM products WHERE item_type= ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $item_type);
		$stmt->execute();
		$result = $stmt->get_result();
		?>


<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo ucfirst($item_type); ?> Collection</title>
<link rel="stylesheet" type="text/css" href="webstyle.css">

<!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
<?php include('header.html');?>


<div class="jewel">
	<h1><?php echo ucfirst($item_type); ?> Collection</h1>
	<table>
			<?php
			
			if ($result->num_rows > 0) {
				$counter = 0;
				while($row = $result->fetch_assoc()) {
					if ($counter % 3 == 0) {
						echo '<tr>'; // Start a new row every 3 items
					}
					
					echo '<td>';
					echo '<div class="product-item">';
					echo "<a href=product_detail.php?product_id=".$row['product_id'].">";
					echo '<img src="images/' . $row["image_url"] . '" alt="' . $row["product_name"] . '" class="product-image" height=400px width=350px align="center">';
					echo '<h2 class="product-name">' . $row["product_name"] . '</h2>';
					echo '<p class="product-price">$' . number_format($row["price"], 2) . '</p>';
					echo '</div>';
					echo '</td>';
					
					$counter++;
					
					if ($counter % 3 == 0) {
						echo '</tr>'; // End the row after 3 items
					}
				}
				if ($counter % 3 != 0) {
					echo '</tr>'; // Close the last row if it's not filled
				}
			} else {
				echo '<tr><td colspan="3">No products found.</td></tr>';
			}

			?>
		</table>
</div>


</body>
</html>
<?php
$stmt->close();
$conn->close();
?>