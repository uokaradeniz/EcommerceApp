<?php
include 'db_connect.php';

$sql_categories = "SELECT * FROM category_table";
$result_categories = $conn->query($sql_categories);

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $stock_quantity = $_POST['stock_quantity'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category_id'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        echo "File Uploaded Successfully.";
    } else {
        echo "Error while uploading the file.";
        $uploadOk = 0;
    }

    if ($uploadOk && isset($target_file)) {
        $sql_add_product = "INSERT INTO products (product_name, product_price, stock_quantity, product_description, category_id, product_image) 
                            VALUES ('$product_name', '$product_price', '$stock_quantity', '$product_description', '$category_id', '$target_file')";
        if ($conn->query($sql_add_product) === TRUE) {
            echo "Product added successfully.";
        } else {
            echo "Error while adding the product: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="checkout.css">

</head>

<body>

    <h2>Add Product</h2>

    <form method="post" action="" enctype="multipart/form-data">
        Product Name: <input type="text" name="product_name"><br>
        Price: <input type="text" name="product_price"><br>
        Stock Quantity: <input type="text" name="stock_quantity"><br>
        Description: <textarea name="product_description"></textarea><br>
        Category:
        <select name="category_id">
            <?php
            if ($result_categories->num_rows > 0) {
                while ($row = $result_categories->fetch_assoc()) {
                    echo "<option value='" . $row["category_id"] . "'>" . $row["category_name"] . "</option>";
                }
            } else {
                echo "<option value=''>Categories not found.</option>";
            }
            ?>
        </select><br>
        Choose a File: <input type="file" name="product_image"><br><br>
        <input type="submit" class="btn" name="add_product" value="Submit">
    </form>
    <br><br>
    <a href="dashboard.php" class="btn">Return to the Dashboard</a>
</body>

</html>