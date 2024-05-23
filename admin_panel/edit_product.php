<?php
include 'db_connect.php';

$sql_categories = "SELECT * FROM category_table";
$result_categories = $conn->query($sql_categories);

if (isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $stock_quantity = $_POST['stock_quantity'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category_id'];

    if (!empty($_FILES['product_image']['name'])) {
        $file_name = $_FILES['product_image']['name'];
        $file_tmp = $_FILES['product_image']['tmp_name'];

        move_uploaded_file($file_tmp, "uploads/" . $file_name);
        $product_image_path = "uploads/" . $file_name;
        $sql_update_product = "UPDATE products SET product_name='$product_name', product_price='$product_price', stock_quantity='$stock_quantity', product_description='$product_description', category_id='$category_id', product_image='$product_image_path' WHERE product_id='$product_id'";

        if ($conn->query($sql_update_product) === TRUE) {
            echo "Product Updated Successfully.";
        } else {
            echo "Error: " . $sql_update_product . "<br>" . $conn->error;
        }
    } else {
        echo "Choose a new image.";
    }
}


if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $sql_get_product = "SELECT * FROM products WHERE product_id='$product_id'";
    $result_get_product = $conn->query($sql_get_product);
    $row = $result_get_product->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="checkout.css">

</head>

<body>

    <h2>Edit Product</h2>

    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
        Product Name: <input type="text" name="product_name" value="<?php echo $row["product_name"]; ?>"><br>
        Price: <input type="text" name="product_price" value="<?php echo $row["product_price"]; ?>"><br>
        Stock Quantity: <input type="text" name="stock_quantity" value="<?php echo $row["stock_quantity"]; ?>"><br>
        Description: <textarea name="product_description"><?php echo $row["product_description"]; ?></textarea><br>
        Category:
        <select name="category_id">
            <?php
            if ($result_categories->num_rows > 0) {
                while ($category = $result_categories->fetch_assoc()) {
                    echo "<option value='" . $category["category_id"] . "'";
                    if ($category["category_id"] == $row["category_id"]) {
                        echo " selected";
                    }
                    echo ">" . $category["category_name"] . "</option>";
                }
            }
            ?>
        </select><br>
        Choose a image: <input type="file" name="product_image"><br><br>
        <input type="submit" class="btn" name="edit_product" value="Update Product">
    </form>
    <br><br>
    <a href="product_list.php" class="btn">Return to the Product List</a>
</body>

</html>