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
        <nav>
            <h1>UOKBurada E-Commerce</h1><br>
            <ul>
                <li><a href="homepage.php">Ana Sayfa</a></li>
                <li><a href="cart.php">Sepetim</a></li>
                <li><a href="contact.php">İletişim</a></li>
                <li><a href="index.php" style="color: red;">Admin Panel(Debugging için)</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <img src="uploads/sepet.png" alt="Sepet">
        <h2>Sepetinizdeki Ürünler</h2>
        <div class="cart">
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                $total_price = 0;
                echo '<form action="order_form.php" method="post">';
                echo '<ul>';
                foreach ($_SESSION['cart'] as $item) {
                    $item_total = $item['product_price'] * $item['product_quantity'];
                    $total_price += $item_total;
                    echo '<li>';
                    echo '<p>Ürün Adı: ' . $item['product_name'] . '</p>';
                    echo '<p>Fiyat: ' . $item['product_price'] . ' TL</p>';
                    echo '<p>Adet: ' . $item['product_quantity'] . '</p>';
                    echo '<p>Toplam: ' . $item_total . ' TL</p>';
                    echo '<input type="hidden" name="products[]" value="' . $item['product_id'] . '">';
                    echo '<input type="hidden" name="quantities[]" value="' . $item['product_quantity'] . '">';
                    echo '</li>';
                }
                echo '</ul>';
                echo '<p><strong>Toplam Fiyat: ' . $total_price . ' TL</strong></p>';
                echo '<button type="submit">Siparişi Tamamla</button>';
                echo '</form>';
                echo '<form action="empty_cart.php" method="post" style="margin-top: 10px;">';
                echo '<button type="submit">Sepeti Boşalt</button>';
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