<?php
session_start();
include 'db_connect.php';

// Kategorinin ID'sini URL parametresinden al
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

// Kategorinin bilgilerini veritabanından çek
$sql = "SELECT category_name FROM category_table WHERE category_id = $category_id";
$result = $conn->query($sql);
$category_name = "Kategori bulunamadı";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $category_name = $row['category_name'];
}

// Kategoriye ait ürünleri veritabanından çek
$sql_products = "SELECT product_id, product_name, product_image, product_price, product_description, stock_quantity FROM products WHERE category_id = $category_id";
$result_products = $conn->query($sql_products);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category_name; ?> - E-Ticaret Sitesi</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Ekstra stiller */
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            /* Kategorileri ortala */
        }

        nav li {
            margin: 0 10px;
        }

        nav select {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
        }

        nav select option {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <header>
        <h1><?php echo $category_name; ?></h1>
        <nav>
            <ul>
                <li><a href="homepage.php">Ana Sayfa</a></li>
                <!-- Dropdown menü -->
                <li>
                    <select onchange="location = this.value;">
                        <option value="">Kategori Seç</option>
                        <?php
                        $sql = "SELECT category_id, category_name FROM category_table";
                        $result_categories = $conn->query($sql);

                        if ($result_categories->num_rows > 0) {
                            while($row = $result_categories->fetch_assoc()) {
                                echo '<option value="category.php?category_id=' . $row["category_id"] . '">' . $row["category_name"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Kategori bulunamadı</option>';
                        }
                        ?>
                    </select>
                </li>
                <li><a href="cart.php">Sepetim</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2><?php echo $category_name; ?> Kategorisi</h2>
        <div class="products">
            <?php
            if ($result_products->num_rows > 0) {
                while($product = $result_products->fetch_assoc()) {
                    echo '<div class="product">';
                    echo '<h3>' . $product["product_name"] . '</h3>';
                    echo '<img src="' . $product["product_image"] . '" alt="' . $product["product_name"] . '" class="product-image">';
                    echo '<p>' . $product["product_description"] . '</p>';
                    echo '<p>Fiyat: ' . $product["product_price"] . ' TL</p>';
                    echo '<p>Stok Miktarı: ' . $product["stock_quantity"] . '</p>';
                    echo '<form action="add_to_cart.php" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . $product["product_id"] . '">';
                    echo '<input type="hidden" name="product_name" value="' . $product["product_name"] . '">';
                    echo '<input type="hidden" name="product_price" value="' . $product["product_price"] . '">';
                    echo '<input type="hidden" name="product_quantity" value="1">';
                    echo '<button type="submit">Sepete Ekle</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>Bu kategoride ürün bulunmamaktadır.</p>';
            }
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 E-Ticaret Sitesi</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
