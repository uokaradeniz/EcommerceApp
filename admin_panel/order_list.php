<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Order Details</h1>
    <a href="dashboard.php">Return to the Dashboard</a>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Shipping Address</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Actions</th> <!-- Yeni sütun eklendi -->
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db_connect.php';

            // Siparişleri veritabanından çek
            $sql = "SELECT orders.*, products.product_name, products.product_image, order_items.quantity
                        FROM orders
                        INNER JOIN order_items ON orders.order_id = order_items.order_id
                        INNER JOIN products ON order_items.product_id = products.product_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Veritabanındaki her bir sipariş için bir satır oluştur
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["order_id"] . "</td>";
                    echo "<td>" . $row["customer_name"] . "</td>";
                    echo "<td>" . $row["customer_email"] . "</td>";
                    echo "<td>" . $row["order_date"] . "</td>";
                    echo "<td>$" . $row["total_amount"] . "</td>";
                    echo "<td>" . $row["shipping_address"] . "</td>";
                    echo "<td>" . $row["product_name"] . "</td>";
                    echo "<td><img src='" . $row["product_image"] . "' alt='Product Image'></td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td><a href='delete_order.php?id=" . $row["order_id"] . "'>Delete</a></td>"; // Siparişi silmek için bağlantı eklendi
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No orders found</td></tr>"; // colspan değeri sütun sayısına göre güncellendi
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
