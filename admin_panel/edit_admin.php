<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $admin_id = $_GET['admin_id'];

    $sql = "SELECT admin_name, admin_surname, admin_username, admin_status FROM admin_table WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $stmt->bind_result($admin_name, $admin_surname, $admin_username, $admin_status);
    $stmt->fetch();
    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $admin_surname = $_POST['admin_surname'];
    $admin_username = $_POST['admin_username'];
    $admin_status = isset($_POST['admin_status']) ? 1 : 0;

    $sql = "UPDATE admin_table SET admin_name = ?, admin_surname = ?, admin_username = ?, admin_status = ? WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $admin_name, $admin_surname, $admin_username, $admin_status, $admin_id);

    if ($stmt->execute()) {
        echo "Admin successfully updated.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    echo "<br><a href='admin_list.php'class='btn'>Return to the Admin List</a>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Admin</title>
    <link rel="stylesheet" href="checkout.css">

</head>

<body>

    <h2>Edit Admin</h2>

    <form method="post" action="">
        <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
        Name:<br>
        <input type="text" name="admin_name" value="<?php echo $admin_name; ?>" required>
        <br>
        Surname:<br>
        <input type="text" name="admin_surname" value="<?php echo $admin_surname; ?>" required>
        <br>
        Username:<br>
        <input type="text" name="admin_username" value="<?php echo $admin_username; ?>" required>
        <br>
        Admin Status:<br>
        <input type="checkbox" name="admin_status" <?php echo $admin_status ? 'checked' : ''; ?>>
        <br><br>
        <input type="submit" value="Edit">
    </form>

    <br>
    <a href="admin_list.php" class="btn">Return to the Admin List</a>