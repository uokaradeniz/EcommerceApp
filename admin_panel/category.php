<?php
session_start();
include 'db_connect.php';

$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

$sql = "SELECT category_name FROM category_table WHERE category_id = $category_id";
$result = $conn->query($sql);
$category_name = "Kategori bulunamadı";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $category_name = $row['category_name'];
}

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
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        nav li {
            margin: 0 10px;
        }

        select {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
        }

        select option {
            font-size: 16px;
        }

        .product {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            width: 200px;
            float: left;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            cursor: pointer;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .product p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .product .price {
            font-weight: bold;
            color: #007bff;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
    <nav>
            <h1>UOKBurada E-Commerce</h1><br>
            <ul>
                <li><a href="homepage.php">Ana Sayfa</a></li>
                <li> <img src="uploads/carts.png" style="max-width: 30px; height: auto;" alt="Sepet">
                    <a href="cart.php"> Sepet</a>
                </li>
                <li><a href="contact.php">İletişim</a></li>
                <li><a href="index.php" style="color: red;">Admin Panel(Debugging için)</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <select onchange="location = this.value;">
            <option value="">Kategori Seç</option>
            <?php
            $sql = "SELECT category_id, category_name FROM category_table ORDER BY category_order";
            $result_categories = $conn->query($sql);

            if ($result_categories->num_rows > 0) {
                while ($row = $result_categories->fetch_assoc()) {
                    echo '<option value="category.php?category_id=' . $row["category_id"] . '">' . $row["category_name"] . '</option>';
                }
            } else {
                echo '<option value="">Kategori bulunamadı</option>';
            }
            ?>
        </select>
        <h2><?php echo $category_name; ?> Kategorisi</h2>
        <div class="products">
            <?php
            if ($result_products->num_rows > 0) {
                while ($product = $result_products->fetch_assoc()) {
                    echo '<div class="product">';
                    echo '<h3>' . $product["product_name"] . '</h3>';
                    echo '<a href="product_detail.php?product_id=' . $product["product_id"] . '"><img src="' . $product["product_image"] . '" alt="' . $product["product_name"] . '" class="product-image"></a>';
                    echo '<p>Fiyat: ' . $product["product_price"] . ' TL</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>Bu kategoride ürün bulunmamaktadır.</p>';
            }
            ?>
        </div>
    </main>
    <footer style="display: flex; justify-content:center;">
        <p>UOKBurada.com E-Commerce</p>
    </footer>
</body>

</html>

<?php
$conn->close();
?>