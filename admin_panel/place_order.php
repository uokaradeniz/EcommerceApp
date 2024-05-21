<?php
include 'db_connect.php';

// Form verilerini al
$product_id = $_POST['product'];
$quantity = $_POST['quantity'];
$customer_name = $_POST['name'];
$customer_email = $_POST['email'];
$shipping_address = $_POST['address'];

// Ürün bilgilerini al
$sql_product = "SELECT * FROM products WHERE product_id = $product_id";
$result_product = $conn->query($sql_product);

if ($result_product->num_rows > 0) {
    $row_product = $result_product->fetch_assoc();
    $product_name = $row_product['product_name'];
    $product_price = $row_product['product_price'];
    $stock_quantity = $row_product['stock_quantity'];

    if ($stock_quantity >= $quantity) {
        // Toplam miktarı hesapla
        $total_amount = $quantity * $product_price;

        // Sipariş bilgilerini orders tablosuna ekle
        $sql_order = "INSERT INTO orders (customer_name, customer_email, order_date, total_amount, shipping_address) 
                    VALUES ('$customer_name', '$customer_email', NOW(), $total_amount, '$shipping_address')";
        
        if ($conn->query($sql_order) === TRUE) {
            $order_id = $conn->insert_id;

            // Sipariş kalemlerini order_items tablosuna ekle
            $sql_order_item = "INSERT INTO order_items (order_id, product_id, quantity) 
                            VALUES ($order_id, $product_id, $quantity)";

            if ($conn->query($sql_order_item) === TRUE) {
                // Ürün miktarını azalt
                $new_stock_quantity = $stock_quantity - $quantity;
                $sql_update_stock = "UPDATE products SET stock_quantity = $new_stock_quantity WHERE product_id = $product_id";

                if ($conn->query($sql_update_stock) === TRUE) {
                    echo "Order placed successfully. Your order ID is: " . $order_id;
                } else {
                    echo "Error updating stock: " . $conn->error;
                }
            } else {
                echo "Error adding order item: " . $conn->error;
            }
        } else {
            echo "Error adding order: " . $conn->error;
        }
    } else {
        echo "Insufficient stock quantity available for this product.";
    }
} else {
    echo "Product not found.";
}

$conn->close();
echo "<a href='dashboard.php'>Return to the Dashboard</a>";

?>
