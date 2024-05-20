<?php
include 'db_connect.php';

$product_id = $_POST['product_id'];

$sql = "DELETE FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);

if ($stmt->execute()) {
    echo "Product deleted successfully.<br><br>";
} else {
    echo "Error: " . $stmt->error . "<br><br>";
}

$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Deleted</title>
</head>
<body>

<a href="product_list.php">Return to Product List</a>

</body>
</html>

