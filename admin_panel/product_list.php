<?php
include 'db_connect.php';

$sql_products = "SELECT * FROM products";
$result_products = $conn->query($sql_products);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .product-image {
            width: 100px;
            height: auto;
        }
    </style>
    <link rel="stylesheet" href="checkout.css">

</head>

<body>

    <h2>Product List</h2>
    <a href="dashboard.php" class="btn">Return to the Dashboard</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Picture</th>
            <th>Price</th>
            <th>Stock Quantity</th>
            <th>Description</th>
            <th>Category ID</th>
            <th>Operations</th>
        </tr>
        <?php
        if ($result_products->num_rows > 0) {
            while ($row = $result_products->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["product_id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td><img class='product-image' src='" . $row["product_image"] . "' alt='Product Image'></td>";
                echo "<td>" . $row["product_price"] . "</td>";
                echo "<td>" . $row["stock_quantity"] . "</td>";
                echo "<td>" . $row["product_description"] . "</td>";
                echo "<td>" . $row["category_id"] . "</td>";
                echo "<td>";
                echo "<form method='post' action='delete_product.php'><input type='hidden' name='product_id' value='" . $row["product_id"] . "'><input type='submit' value='Delete'></form><br>";
                echo "<form method='post' action='edit_product.php'><input type='hidden' name='product_id' value='" . $row["product_id"] . "'><input type='submit' value='Edit'></form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Product Not Found.</td></tr>";
        }
        ?>
    </table>

</body>

</html>