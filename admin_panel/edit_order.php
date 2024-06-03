<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Order</h1>
        <?php
        include 'db_connect.php';

        if (isset($_GET['id'])) {
            $order_id = (int)$_GET['id'];
            $sql = "SELECT * FROM orders WHERE order_id = $order_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $order = $result->fetch_assoc();
                ?>
                <form action="update_order.php" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <label for="customer_name">Customer Name</label>
                    <input type="text" id="customer_name" name="customer_name" value="<?php echo $order['customer_name']; ?>" required>
                    
                    <label for="customer_email">Customer Email</label>
                    <input type="email" id="customer_email" name="customer_email" value="<?php echo $order['customer_email']; ?>" required>
                    
                    <label for="shipping_address">Shipping Address</label>
                    <textarea id="shipping_address" name="shipping_address" required><?php echo $order['shipping_address']; ?></textarea>
                    
                    <label for="telephone_number">Telephone Number</label>
                    <input type="text" id="telephone_number" name="telephone_number" value="<?php echo $order['telephone_number']; ?>" required>
                    
                    <label for="total_amount">Total Amount (TRY)</label>
                    <input type="number" step="0.01" id="total_amount" name="total_amount" value="<?php echo $order['total_amount']; ?>" required>
                    
                    <label for="order_date">Order Date</label>
                    <input type="datetime-local" id="order_date" name="order_date" value="<?php echo date('Y-m-d\TH:i', strtotime($order['order_date'])); ?>" required>

                    <input type="submit" class="btn" value="Update Order">
                </form>
                <?php
            } else {
                echo "<p>Order not found.</p>";
            }
        } else {
            echo "<p>Invalid order ID.</p>";
        }
        $conn->close();
        ?>
        <br>
        <a href="orders.php" class="btn">Back to Orders</a>
    </div>
</body>
</html>
