<?php
include 'db_connect.php';

// Ürünün ID'sini URL parametresinden al
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;

// Ürün bilgilerini veritabanından çek
$sql = "SELECT * FROM products WHERE product_id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    // Ürün bulunamadıysa, hata mesajı göster ve işlemi sonlandır
    die('Ürün bulunamadı.');
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['product_name']; ?> - Ürün Detayı</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Ekstra stiller */
        .product-detail {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
        }

        .product-detail img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .product-detail h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .product-detail p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .product-detail .price {
            font-weight: bold;
            color: #007bff;
            font-size: 18px;
        }

        .product-detail form {
            margin-top: 20px;
        }

        .product-detail label {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .product-detail input[type="number"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100px;
        }

        .product-detail button {
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .product-detail button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body style="margin-top:5%;">
    <div class="product-detail">
        <h1>Ürün Detayları</h1>
        <img src="<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>">
        <h2><?php echo $product['product_name']; ?></h2>
        <p>Ürün Açıklaması: <?php echo $product['product_description']; ?></p>
        <p class="price">Fiyat: <?php echo $product['product_price']; ?> TL</p>
        <p>Stok Miktarı: <?php echo $product['stock_quantity'] ?></p>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>">
            <label for="quantity">Adet:</label>
            <input type="number" id="quantity" name="product_quantity" min="1" value="1">
            <button type="submit">Sepete Ekle</button>
        </form>
    </div>
</body>

</html>

<?php
$conn->close();
?>