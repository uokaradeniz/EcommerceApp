<?php
// Veritabanı bağlantısı
include 'db_connect.php';

// Ürünleri getirme
$sql_products = "SELECT * FROM products";
$result_products = $conn->query($sql_products);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ürün Listesi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Ürün Listesi</h2>
<a href="dashboard.php">Return to Dashboard</a>

<table>
    <tr>
        <th>ID</th>
        <th>Ürün Adı</th>
        <th>Fiyat</th>
        <th>Stok Miktarı</th>
        <th>Açıklama</th>
        <th>Kategori ID</th>
        <th>Operations</th>
    </tr>
    <?php
    if ($result_products->num_rows > 0) {
        while($row = $result_products->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["product_id"] . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>" . $row["product_price"] . "</td>";
            echo "<td>" . $row["stock_quantity"] . "</td>";
            echo "<td>" . $row["product_description"] . "</td>";
            echo "<td>" . $row["category_id"] . "</td>";
            echo "<td>";
            echo "<form method='post' action='delete_product.php'><input type='hidden' name='product_id' value='" . $row["product_id"] . "'><input type='submit' value='Delete'></form>";
            echo "<form method='post' action='edit_product.php'><input type='hidden' name='product_id' value='" . $row["product_id"] . "'><input type='submit' value='Edit'></form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Ürün bulunamadı.</td></tr>";
    }
    ?>
</table>

</body>
</html>
