<?php
// Veritabanı bağlantısı
include 'db_connect.php';

// Kategori bilgilerini getir
$sql_categories = "SELECT * FROM category_table";
$result_categories = $conn->query($sql_categories);

if(isset($_POST['edit_product'])) {
    // Diğer kodlar buraya yerleştirilecek
}

// Ürün bilgilerini getirme
if(isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $sql_get_product = "SELECT * FROM products WHERE product_id='$product_id'";
    $result_get_product = $conn->query($sql_get_product);
    $row = $result_get_product->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ürün Düzenle</title>
    <link rel="stylesheet" href="checkout.css">

</head>
<body>

<h2>Ürün Düzenle</h2>
<a href="product_list.php" class="btn">Ürün Listesine Geri Dön</a>

<form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
    Ürün Adı: <input type="text" name="product_name" value="<?php echo $row["product_name"]; ?>"><br>
    Fiyat: <input type="text" name="product_price" value="<?php echo $row["product_price"]; ?>"><br>
    Stok Miktarı: <input type="text" name="stock_quantity" value="<?php echo $row["stock_quantity"]; ?>"><br>
    Açıklama: <textarea name="product_description"><?php echo $row["product_description"]; ?></textarea><br>
    Kategori: 
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
    Resim Seçin: <input type="file" name="product_image"><br>
    <input type="submit" name="edit_product" value="Ürünü Güncelle">
</form>

</body>
</html>
