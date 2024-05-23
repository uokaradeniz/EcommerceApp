<html>

<head>
    <link rel="stylesheet" href="checkout.css">

</head>

</html>
<?php
include 'db_connect.php';

$order_id = $_GET['id'];

$sql_delete_order = "DELETE FROM orders WHERE order_id = $order_id";
if ($conn->query($sql_delete_order) === TRUE) {
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
echo "<a href='order_list.php' class='btn'>Return to the Orders</a>";
?>