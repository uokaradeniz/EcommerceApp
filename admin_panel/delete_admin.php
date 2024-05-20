<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_id = $_POST['admin_id'];

    $sql = "DELETE FROM admin_table WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Preparation Error: " . $conn->error);
    }
    $stmt->bind_param("i", $admin_id);

    if ($stmt->execute()) {
        echo "Admin successfully deleted.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Deleted</title>
</head>
<body>

<a href="admin_list.php">Return to Admin List</a>

</body>
</html>
