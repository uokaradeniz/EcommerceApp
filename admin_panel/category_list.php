<?php
include 'db_connect.php';

$sql = "SELECT category_id, category_name, category_order FROM category_table";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Category List</title>
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
            background-color: #007bff;
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
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <link rel="stylesheet" href="checkout.css">

</head>

<body>

    <h2>Category List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Order</th>
            <th>Operations</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["category_id"] . "</td>";
                echo "<td>" . $row["category_name"] . "</td>";
                echo "<td>" . $row["category_order"] . "</td>";
                echo "<td>";
                echo "<form method='post' action='delete_category.php'><input type='hidden' name='category_id' value='" . $row["category_id"] . "'><input type='submit' value='Delete'></form><br>";
                echo "<form method='get' action='edit_category.php'><input type='hidden' name='category_id' value='" . $row["category_id"] . "'><input type='submit' value='Edit'></form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Can't find Category</td></tr>";
        }
        ?>
    </table>
    <br><br>
    <a href="dashboard.php" class="btn">Return to Dashboard</a>

    <?php
    $conn->close();
    ?>

</body>

</html>