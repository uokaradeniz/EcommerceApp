<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
</head>
<body>
    <h1>Place Order</h1>
    <a href="dashboard.php">Return to the Dashboard</a>

    <form action="place_order.php" method="post">
        <label for="product">Select Product:</label>
        <select name="product" id="product" onchange="showDescription()">
            <?php
                include 'db_connect.php';

                // Ürünleri veritabanından çek
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Veritabanındaki her bir ürünü bir seçenek olarak ekrana yazdır
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["product_id"] . "' data-description='" . $row["product_description"] . "'>" . $row["product_name"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No products found</option>";
                }
                $conn->close();
            ?>
        </select>
        <br><br>
        <label for="description">Product Description:</label>
        <textarea id="description" name="description" readonly></textarea>
        <br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1">
        <br><br>
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="address">Shipping Address:</label>
        <textarea id="address" name="address" required></textarea>
        <br><br>
        <input type="submit" value="Place Order">
    </form>

    <script>
        function showDescription() {
            var productSelect = document.getElementById("product");
            var descriptionTextarea = document.getElementById("description");
            var selectedOption = productSelect.options[productSelect.selectedIndex];
            descriptionTextarea.value = selectedOption.getAttribute("data-description");
        }
    </script>
</body>
</html>
