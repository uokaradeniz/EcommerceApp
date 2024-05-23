<?php
session_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Ver - Ödeme</title>
    <link rel="stylesheet" href="checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <h1>Sipariş Ver - Ödeme</h1>
        <a href="dashboard.php" class="btn">Dashboard'a Dön</a>
        <div class="row">
            <div class="col-75">
                <div class="order-form">
                    <form action="place_order.php" method="post">
                        <div class="row">
                            <div class="col-50">
                                <h3>Sipariş Detayları</h3>
                                <?php
                                if (isset($_POST['products']) && isset($_POST['quantities']) && isset($_POST['total_price'])) {
                                    $products = $_POST['products'];
                                    $quantities = $_POST['quantities'];
                                    $total_price = $_POST['total_price'];

                                    for ($i = 0; $i < count($products); $i++) {
                                        $product_id = (int)$products[$i];
                                        $quantity = (int)$quantities[$i];

                                        include 'db_connect.php';
                                        $sql = "SELECT product_name FROM products WHERE product_id = $product_id";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $product_name = $row['product_name'];
                                            echo '<p>Ürün: ' . $product_name . ' - Adet: ' . $quantity . '</p>';
                                        }
                                        $conn->close();

                                        echo '<input type="hidden" name="products[]" value="' . $product_id . '">';
                                        echo '<input type="hidden" name="quantities[]" value="' . $quantity . '">';
                                    }

                                    echo '<p>Toplam Fiyat: ' . $total_price . ' TL</p>';
                                    echo '<input type="hidden" name="total_price" value="' . $total_price . '">';
                                } else {
                                    echo '<p>Geçersiz sipariş bilgisi.</p>';
                                    exit;
                                }

                                if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address'])) {
                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    $address = $_POST['address'];

                                    echo '<input type="hidden" name="name" value="' . $name . '">';
                                    echo '<input type="hidden" name="email" value="' . $email . '">';
                                    echo '<input type="hidden" name="address" value="' . $address . '">';
                                } else {
                                    echo '<p>Geçersiz kargo bilgisi.</p>';
                                    exit;
                                }
                                ?>
                            </div>
                            <div class="col-50">
                                <h3>Ödeme</h3>
                                <label for="fname">Kabul Edilen Kartlar</label>
                                <div class="icon-container">
                                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                                </div>
                                <label for="cname">Kart Üzerindeki İsim</label>
                                <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
                                <label for="ccnum">Kredi Kartı Numarası</label>
                                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
                                <label for="expmonth">Son Kullanma Tarihi (Ay)</label>
                                <input type="text" id="expmonth" name="expmonth" placeholder="Eylül" required>
                                <div class="row">
                                    <div class="col-50">
                                        <label for="expyear">Son Kullanma Tarihi (Yıl)</label>
                                        <input type="text" id="expyear" name="expyear" placeholder="2024" required>
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" name="cvv" placeholder="352" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn" value="Sipariş Ver">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
