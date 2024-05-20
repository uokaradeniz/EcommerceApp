<?php
include 'db_connect.php';

$sql = "SELECT admin_id, admin_name, admin_surname, admin_username FROM admin_table";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin List</title>
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

<h2>Admin List</h2>
<a href="dashboard.php">Return to Dashboard</a>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Username</th>
        <th>Operations</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["admin_id"] . "</td>";
            echo "<td>" . $row["admin_name"] . "</td>";
            echo "<td>" . $row["admin_surname"] . "</td>";
            echo "<td>" . $row["admin_username"] . "</td>";
            echo "<td>";
            echo "<form method='post' action='delete_admin.php'><input type='hidden' name='admin_id' value='" . $row["admin_id"] . "'><input type='submit' value='Delete'></form><br>";
            echo "<form method='get' action='edit_admin.php'><input type='hidden' name='admin_id' value='" . $row["admin_id"] . "'><input type='submit' value='Edit'></form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Can't find Admin</td></tr>";
    }
    ?>
</table>

<?php
$conn->close();
?>

</body>
</html>
