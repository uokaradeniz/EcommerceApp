<?php
session_start();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Ver - Kargo Detayları</title>
    <link rel="stylesheet" href="checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <h1>Sipariş Ver - Kargo Detayları</h1>
        <div class="row">
            <div class="col-75">
                <div class="order-form">
                    <form action="payment.php" method="post" id="orderForm">
                        <div class="row">
                            <div class="col-50">
                                <h3>Sipariş Detayları</h3>
                                <?php
                                if (isset($_POST['products']) && isset($_POST['quantities'])) {
                                    $products = $_POST['products'];
                                    $quantities = $_POST['quantities'];

                                    include 'db_connect.php';
                                    $total_price = 0;

                                    for ($i = 0; $i < count($products); $i++) {
                                        $product_id = (int)$products[$i];
                                        $quantity = (int)$quantities[$i];

                                        $sql = "SELECT product_name, product_price FROM products WHERE product_id = $product_id";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $product_name = $row['product_name'];
                                            $product_price = $row['product_price'];
                                            $total_price += $product_price * $quantity;

                                            echo '<p>Ürün: ' . $product_name . ' - Adet: ' . $quantity . ' - Fiyat: ' . ($product_price * $quantity) . ' TL</p>';
                                            echo '<input type="hidden" name="products[]" value="' . $product_id . '">';
                                            echo '<input type="hidden" name="quantities[]" value="' . $quantity . '">';
                                        }
                                    }
                                    $conn->close();

                                    echo '<p>Toplam Fiyat: ' . $total_price . ' TL</p>';
                                    echo '<input type="hidden" name="total_price" value="' . $total_price . '">';
                                } else {
                                    echo '<p>Sepetinizde ürün bulunmamaktadır.</p>';
                                }
                                ?>
                                <label for="first_name" class="fa fa-user">Adınız:</label>
                                <input type="text" id="first_name" name="first_name" required>
                                <label for="last_name" class="fa fa-user">Soyadınız:</label>
                                <input type="text" id="last_name" name="last_name" required>
                                <label for="email" class="fa fa-envelope">E-mail:</label>
                                <input type="email" id="email" name="email" required>
                                <label for="address" class="fa fa-address-card-o">Adres:</label>
                                <textarea id="address" name="address" required></textarea>
                                <label for="telephone_num" class="fa fa-phone">Telefon Numarası:</label><br>
                                <input type="tel" id="telephone_num" name="telephone_num" required>
                            </div>
                        </div>
                        <input type="hidden" id="name" name="name">
                        <br>
                        <input type="submit" class="btn" value="İleri" onclick="combineNames()">
                    </form>
                    <br><br><a href="cart.php" class="btn">Sepete Geri Dön</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function combineNames() {
            var firstName = document.getElementById('first_name').value;
            var lastName = document.getElementById('last_name').value;
            document.getElementById('name').value = firstName + ' ' + lastName;
        }
    </script>
</body>

</html>