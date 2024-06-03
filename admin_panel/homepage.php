<?php
include 'db_connect.php';

$sql = "SELECT * FROM products WHERE stock_quantity > 0";
$result_products = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa - UOKBurada</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        button[type="submit"]:focus {
            outline: none;
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
            color: #4CAF50
;
            font-size: 16px;
        }

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

        nav a {
            text-decoration: none;
            color: #000;
        }

        h1#firsat-urunleri {
            font-size: 36px;
            text-align: center;
            background: linear-gradient(45deg, #ff7300, #ff0066);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 20px 0;
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
                <li><a href="index.php" style="color: red;">Admin Panel (Debug)</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <img src="uploads/homepage.jpeg">
        <form action="search_product.php" method="GET">
            <input type="text" name="query" placeholder="Ürün Ara...">
            <button type="submit">Ara</button>
        </form>

        <h2>Hoş Geldiniz!</h2>
        <p>En iyi ürünleri en uygun fiyatlarla satın alın.</p>
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
        <h1 id="firsat-urunleri">Fırsat Ürünleri!</h1>

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
                echo '<p>Ürün bulunamadı.</p>';
            }
            ?>
        </div>
        <br><br>
        <img src="uploads/homepage2.jpeg">
        <p>Aenean vel gravida turpis. Nullam aliquet placerat diam in aliquet. Etiam pharetra purus nisl, non iaculis ex dignissim id. Donec risus dolor, tempor quis consequat at, placerat sit amet leo. Nam dignissim lacus eu nulla euismod, vel rutrum nisl accumsan. Nullam condimentum a lacus pharetra rutrum. Sed libero lectus, aliquet sed fringilla vel, scelerisque eu elit. Morbi id diam congue, vestibulum dui quis, imperdiet turpis. Vivamus euismod ante rhoncus neque posuere placerat. Nullam ut pulvinar libero. Pellentesque pharetra pharetra magna a laoreet. Duis auctor erat at lectus vestibulum volutpat. Fusce aliquam est id posuere vulputate.</p>

    </main>
    <footer style="display: flex; justify-content:center;">
        <p>2024 UOKBurada.com</p>
    </footer>
</body>

</html>

<?php
$conn->close();
?>