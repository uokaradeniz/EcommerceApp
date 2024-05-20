<?php
// Veritabanı bağlantısı
include 'db_connect.php';

if(isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $stock_quantity = $_POST['stock_quantity'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category_id'];

    // Dosya yükleme işlemi
    $target_dir = "uploads/"; // Resimlerin yükleneceği dizin
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]); // Yüklenecek dosyanın tam yolu
    $uploadOk = 1; // Yükleme işlemi başarılı mı?

    // Dosya türünü kontrol etmek için bir değişken
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Dosyayı sunucuya yükle
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        echo "Dosya başarıyla yüklendi.";
    } else {
        echo "Dosya yüklenirken bir hata oluştu.";
        $uploadOk = 0;
    }

    // Veritabanına ürünü güncelleme
    if ($uploadOk) {
        $sql_edit_product = "UPDATE products SET product_name='$product_name', product_price='$product_price', stock_quantity='$stock_quantity', product_description='$product_description', category_id='$category_id', product_image='$target_file' WHERE product_id='$product_id'";
        if ($conn->query($sql_edit_product) === TRUE) {
            echo "Ürün başarıyla güncellendi.";
        } else {
            echo "Ürün güncellenirken hata oluştu: " . $conn->error;
        }
    }
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
</head>
<body>

<h2>Ürün Düzenle</h2>
<a href="product_list.php">Ürün Listesine Geri Dön</a>

<form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
    Ürün Adı: <input type="text" name="product_name" value="<?php echo $row["product_name"]; ?>"><br>
    Fiyat: <input type="text" name="product_price" value="<?php echo $row["product_price"]; ?>"><br>
    Stok Miktarı: <input type="text" name="stock_quantity" value="<?php echo $row["stock_quantity"]; ?>"><br>
    Açıklama: <textarea name="product_description"><?php echo $row["product_description"]; ?></textarea><br>
    Kategori ID: <input type="text" name="category_id" value="<?php echo $row["category_id"]; ?>"><br>
    Resim Seçin: <input type="file" name="product_image"><br> <!-- Resim seçimi için dosya yükleme alanı -->
    <input type="submit" name="edit_product" value="Ürünü Güncelle">
</form>

</body>
</html>
