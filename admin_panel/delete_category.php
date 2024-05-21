<?php
include 'db_connect.php';

$sql = "DELETE FROM category_table WHERE category_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $category_id);

if ($stmt->execute()) {
    echo "Category deleted successfully.<br><br>";
} else {
    echo "Error: " . $stmt->error . "<br><br>";
}

$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Deleted</title>
    <link rel="stylesheet" href="checkout.css">

</head>
<body>

<a href="category_list.php"class="btn">Return to Category List</a>

</body>
</html>
