<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $sql = "SELECT category_name, category_order FROM category_table WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $category_name = $row['category_name'];
        $category_order = $row['category_order'];
    } else {
        echo "Category not found.";
        exit();
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_category'])) {
    $category_name = $_POST['category_name'];
    $category_order = $_POST['category_order'];
    $category_id = $_POST['category_id'];

    $sql = "UPDATE category_table SET category_name = ?, category_order = ? WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $category_name, $category_order, $category_id);

    if ($stmt->execute()) {
        echo "Category updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>
    <h2>Edit Category</h2>
    <a href="category_list.php">Return to Category List</a>
    <form action="" method="POST">
        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
        <label for="category_name">Category Name:</label><br>
        <input type="text" id="category_name" name="category_name" value="<?php echo $category_name; ?>" required><br><br>
        <label for="category_order">Category Order:</label><br>
        <input type="number" id="category_order" name="category_order" value="<?php echo $category_order; ?>" required><br><br>
        <input type="submit" name="update_category" value="Update">
    </form>
</body>
</html>
