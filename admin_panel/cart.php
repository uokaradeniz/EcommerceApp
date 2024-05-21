<?php
session_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim - E-Ticaret Sitesi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Sepetim</h1>
        <nav>
            <ul>
                <li><a href="homepage.php">Ana Sayfa</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Sepetinizdeki Ürünler</h2>
        <div class="cart">
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                echo '<form action="order_form.php" method="post">';
                echo '<ul>';
                foreach ($_SESSION['cart'] as $item) {
                    echo '<li>';
                    echo '<p>Ürün Adı: ' . $item['product_name'] . '</p>';
                    echo '<p>Fiyat: ' . $item['product_price'] . ' TL</p>';
                    echo '<p>Adet: ' . $item['product_quantity'] . '</p>';
                    echo '<input type="hidden" name="products[]" value="' . $item['product_id'] . '">';
                    echo '<input type="hidden" name="quantities[]" value="' . $item['product_quantity'] . '">';
                    echo '</li>';
                }
                echo '</ul>';
                echo '<button type="submit">Siparişi Tamamla</button>';
                echo '</form>';
            } else {
                echo '<p>Sepetinizde ürün bulunmamaktadır.</p>';
            }
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 E-Ticaret Sitesi</p>
    </footer>
</body>
</html>
