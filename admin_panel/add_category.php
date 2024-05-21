<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];
    $category_order = $_POST['category_order'];

    $sql = "INSERT INTO category_table (category_name, category_order) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $category_name, $category_order);

    if ($stmt->execute()) {
        echo "New Category Added Successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Category</title>
    <link rel="stylesheet" href="checkout.css">

</head>
<body>
    <h2>Add New Category</h2>
    <a href="dashboard.php"class="btn">Return to the Dashboard</a>

    <form action="" method="POST">
        <label for="category_name">Category Name:</label><br>
        <input type="text" id="category_name" name="category_name" required><br><br>
        <label for="category_order">Category Order:</label><br>
        <input type="number" id="category_order" name="category_order" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

