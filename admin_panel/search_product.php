<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arama Sonuçları - UOKBurada</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add CSS styles for the search results */
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
            color: #4CAF50;
            font-size: 16px;
        }

        /* Additional styles for the search results */
        .search-results {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .search-results .product {
            margin: 10px;
        }
    </style>
</head>

<body>
    <header>
        <!-- Your header content -->
    </header>
    <main>
        <h1>Arama Sonuçları</h1>
        <div class="search-results">
            <?php
            // PHP code to display search results
            include 'db_connect.php';
            if (isset($_GET['query'])) {
                $search_query = $_GET['query'];
                $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_query%' AND stock_quantity > 0";
                $result_search = $conn->query($sql);

                if ($result_search->num_rows > 0) {
                    while ($product = $result_search->fetch_assoc()) {
                        echo '<div class="product">';
                        echo '<h3>' . $product["product_name"] . '</h3>';
                        echo '<a href="product_detail.php?product_id=' . $product["product_id"] . '"><img src="' . $product["product_image"] . '" alt="' . $product["product_name"] . '" class="product-image"></a>';
                        echo '<p>Fiyat: ' . $product["product_price"] . ' TL</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Ürün bulunamadı.</p>';
                }
            }
            $conn->close();
            ?>
        </div>
    </main>
    <footer>
        <!-- Your footer content -->
    </footer>
</body>

</html>
