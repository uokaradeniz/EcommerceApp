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

<h2>Category List</h2>
<a href="dashboard.php">Return to Dashboard</a>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Order</th>
        <th>Operations</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
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

<?php
$conn->close();
?>

</body>
</html>
