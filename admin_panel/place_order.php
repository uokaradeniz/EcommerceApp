<html>

<head>
    <link rel="stylesheet" href="checkout.css">
</head>

</html>

<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $total_price = $_POST['total_price'];
    $products = $_POST['products'];
    $quantities = $_POST['quantities'];
    $cardname = $_POST['cardname'];
    $cardnumber = $_POST['cardnumber'];
    $expmonth = $_POST['expmonth'];
    $expyear = $_POST['expyear'];
    $cvv = $_POST['cvv'];

    // Sipariş bilgilerini veritabanına kaydet
    $sql_order = "INSERT INTO orders (customer_name, customer_email, shipping_address, total_amount) 
                  VALUES ('$name', '$email', '$address', $total_price)";

    if ($conn->query($sql_order) === TRUE) {
        $order_id = $conn->insert_id;

        // Sipariş detaylarını veritabanına kaydet
        for ($i = 0; $i < count($products); $i++) {
            $product_id = (int)$products[$i];
            $quantity = (int)$quantities[$i];

            $sql_order_item = "INSERT INTO order_items (order_id, product_id, quantity) 
                               VALUES ($order_id, $product_id, $quantity)";

            if ($conn->query($sql_order_item) !== TRUE) {
                echo "Error adding order item: " . $conn->error;
                exit;
            }
        }

        // Sipariş tamamlandıktan sonra sepeti temizle
        unset($_SESSION['cart']);

        echo "Siparişiniz başarıyla alındı. Sipariş numaranız: " . $order_id;
        echo "<a href='dashboard.php' class='btn'>Dashboard'a Geri Dön</a>";
    } else {
        echo "Sipariş eklenirken bir hata oluştu: " . $conn->error;
    }
} else {
    echo "Geçersiz istek.";
}

$conn->close();
?>