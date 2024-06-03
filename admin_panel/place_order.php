<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $telephone_num = $_POST['telephone_num'];
    $total_price = $_POST['total_price'];
    $products = $_POST['products'];
    $quantities = $_POST['quantities'];

    $cardname = $_POST['cardname'];
    $cardnumber = $_POST['cardnumber'];
    $expmonth = $_POST['expmonth'];
    $expyear = $_POST['expyear'];
    $cvv = $_POST['cvv'];

    $sql = "INSERT INTO orders (customer_name, customer_email, order_date, total_amount, shipping_address, telephone_number) VALUES (?, ?, NOW(), ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $name, $email, $total_price, $address, $telephone_num);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        $sql = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        for ($i = 0; $i < count($products); $i++) {
            $product_id = (int)$products[$i];
            $quantity = (int)$quantities[$i];
            $stmt->bind_param("iii", $order_id, $product_id, $quantity);
            $stmt->execute();
        }

        echo "Siparişiniz başarıyla alınmıştır.";
    } else {
        echo "Siparişiniz alınırken bir hata oluştu: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Geçersiz istek yöntemi.";
}
?>
