<?php
session_start();

// Sepetten ürün silme işlemi
if (isset($_GET['remove']) && isset($_SESSION['cart'])) {
    $remove_id = $_GET['remove'];

    // Sepetten kaldırılacak ürünün indisini bul
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_id'] == $remove_id) {
            // İlgili ürünü sepetten kaldır
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    // Yeniden sırala
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    // Yönlendir
    header('Location: cart.php');
    exit();
}

// Sepetteki ürün miktarını arttırma işlemi
if (isset($_GET['increase']) && isset($_SESSION['cart'])) {
    $increase_id = $_GET['increase'];

    // İlgili ürünün miktarını arttır
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $increase_id) {
            $item['product_quantity']++;
            break;
        }
    }

    // Yönlendir
    header('Location: cart.php');
    exit();
}

// Sepetteki ürün miktarını azaltma işlemi
if (isset($_GET['decrease']) && isset($_SESSION['cart'])) {
    $decrease_id = $_GET['decrease'];

    // İlgili ürünün miktarını azalt
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $decrease_id) {
            if ($item['product_quantity'] > 1) {
                $item['product_quantity']--;
            }
            break;
        }
    }

    // Yönlendir
    header('Location: cart.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet - UOKBurada</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .cart {
            margin: 20px 0;
        }

        .total-price {
            margin-top: 20px;
            font-weight: bold;
        }

        .buttons {
            margin-top: 20px;
        }

        .buttons button {
            margin-right: 10px;
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .buttons button:hover {
            background-color: #45a049;
        }

        a {
            color: #4CAF50
;
            text-decoration: none;
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
        <h2>Sepetinizdeki Ürünler</h2>
        <div class="cart">
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                $total_price = 0;
                echo '<form action="order_form.php" method="post">';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Ürün Adı</th>';
                echo '<th>Fiyat (TL)</th>';
                echo '<th>Adet</th>';
                echo '<th>Toplam (TL)</th>';
                echo '<th>İşlem</th>'; // Yeni kolon: İşlem
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($_SESSION['cart'] as $item) {
                    $item_total = $item['product_price'] * $item['product_quantity'];
                    $total_price += $item_total;
                    echo '<tr>';
                    echo '<td>' . $item['product_name'] . '</td>';
                    echo '<td>' . $item['product_price'] . '</td>';
                    echo '<td>';
                    echo '<a href="cart.php?decrease=' . $item['product_id'] . '">- </a>';
                    echo $item['product_quantity'];
                    echo '<a href="cart.php?increase=' . $item['product_id'] . '"> +</a>';
                    echo '</td>';
                    echo '<td>' . $item_total . '</td>';
                    echo '<td><a href="cart.php?remove=' . $item['product_id'] . '">Sil</a></td>'; // Silme bağlantısı ekle
                    echo '<input type="hidden" name="products[]" value="' . $item['product_id'] . '">';
                    echo '<input type="hidden" name="quantities[]" value="' . $item['product_quantity'] . '">';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '<p class="total-price">Toplam Fiyat: ' . $total_price . ' TL</p>';
                echo '<div class="buttons">';
                echo '<button type="submit">Siparişi Tamamla</button>';
                echo '</form>';
                echo '<form action="empty_cart.php" method="post" style="display: inline;">';
                echo '<button type="submit">Sepeti Boşalt</button>';
                echo '</form>';
                echo '</div>';
            } else {
                echo '<p>Sepetinizde ürün bulunmamaktadır.</p>';
            }
            ?>
        </div>
    </main>
    <footer>
        <p>2024 - UOKBurada.com</p>
    </footer>
</body>

</html>