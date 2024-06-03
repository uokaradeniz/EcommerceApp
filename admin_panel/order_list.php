<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td img {
            max-width: 50px;
            height: auto;
            margin-right: 5px;
        }

        a {
            color: #4CAF50
;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1 style="text-align: left;">Order Details</h1>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Shipping Address</th>
                <th>Telephone Number</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db_connect.php';

            $sql = "SELECT orders.*, GROUP_CONCAT(products.product_name SEPARATOR ', ') AS product_names, GROUP_CONCAT(products.product_image SEPARATOR ', ') AS product_images, SUM(order_items.quantity) AS total_quantity
                        FROM orders
                        INNER JOIN order_items ON orders.order_id = order_items.order_id
                        INNER JOIN products ON order_items.product_id = products.product_id
                        GROUP BY orders.order_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["order_id"] . "</td>";
                    echo "<td>" . $row["customer_name"] . "</td>";
                    echo "<td>" . $row["customer_email"] . "</td>";
                    echo "<td>" . $row["order_date"] . "</td>";
                    echo "<td>TRY " . $row["total_amount"] . "</td>";
                    echo "<td>" . $row["shipping_address"] . "</td>";
                    echo "<td>" . $row["telephone_number"] . "</td>";
                    echo "<td>" . $row["product_names"] . "</td>";
                    echo "<td>";
                    $images = explode(", ", $row["product_images"]);
                    foreach ($images as $image) {
                        echo "<img src='" . $image . "' alt='Product Image'>";
                    }
                    echo "</td>";
                    echo "<td>" . $row["total_quantity"] . "</td>";
                    echo "<td><a href='edit_order.php?id=" . $row["order_id"] . "'>Edit</a> | <a href='delete_order.php?id=" . $row["order_id"] . "'>Delete</a></td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No orders found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <br><br>
    <a href="dashboard.php" class="btn">Return to the Dashboard</a>

</body>

</html>
