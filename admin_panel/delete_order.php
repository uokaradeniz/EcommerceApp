<?php
include 'db_connect.php';

// Sipariş ID'sini al
$order_id = $_GET['id'];

// Siparişi sil
$sql_delete_order = "DELETE FROM orders WHERE order_id = $order_id";
if ($conn->query($sql_delete_order) === TRUE) {
    // Sipariş kalemlerini de sil
    $sql_delete_order_items = "DELETE FROM order_items WHERE order_id = $order_id";
    if ($conn->query($sql_delete_order_items) === TRUE) {
        echo "Order deleted successfully.";
    } else {
        echo "Error deleting order items: " . $conn->error;
    }
} else {
    echo "Error deleting order: " . $conn->error;
}

$conn->close();
echo "<a href='order_list.php'>Return to the Orders</a>";
?>
