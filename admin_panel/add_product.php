<?php
include 'db_connect.php';

$sql_categories = "SELECT * FROM category_table";
$result_categories = $conn->query($sql_categories);

if(isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $stock_quantity = $_POST['stock_quantity'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category_id'];

    $sql_add_product = "INSERT INTO products (product_name, product_price, stock_quantity, product_description, category_id) 
                        VALUES ('$product_name', '$product_price', '$stock_quantity', '$product_description', '$category_id')";
    if ($conn->query($sql_add_product) === TRUE) {
        echo "Ürün başarıyla eklendi.";
    } else {
        echo "Ürün eklenirken hata oluştu: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ürün Yönetimi</title>
</head>
<body>

<h2>Ürün Ekle</h2>
<a href="dashboard.php">Get back to the Dashboard</a>

<form method="post" action="">
    Ürün Adı: <input type="text" name="product_name"><br>
    Fiyat: <input type="text" name="product_price"><br>
    Stok Miktarı: <input type="text" name="stock_quantity"><br>
    Açıklama: <textarea name="product_description"></textarea><br>
    Kategori: 
    <select name="category_id">
        <?php
        if ($result_categories->num_rows > 0) {
            while($row = $result_categories->fetch_assoc()) {
                echo "<option value='" . $row["category_id"] . "'>" . $row["category_name"] . "</option>";
            }
        } else {
            echo "<option value=''>Kategori bulunamadı.</option>";
        }
        ?>
    </select><br>
    <input type="submit" name="add_product" value="Ürün Ekle">
</form>
</body>
</html>
