<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_name = $_POST['admin_name'];
    $admin_surname = $_POST['admin_surname'];
    $admin_username = $_POST['admin_username'];
    $admin_pass = $_POST['admin_pass'];
    $admin_status = isset($_POST['admin_status']) ? 1 : 0;

    $sql = "INSERT INTO admin_table (admin_name, admin_surname, admin_username, admin_pass, admin_status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $admin_name, $admin_surname, $admin_username, $admin_pass, $admin_status);

    if ($stmt->execute()) {
        echo "New admin created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>

<head>
    <title>Add Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
    <meta name="author" content="" />

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800" type="text/css">
    <link rel="stylesheet" href="admin_template/Theme/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="admin_template/Theme/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="admin_template/Theme/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />

    <link rel="stylesheet" href="admin_template/Theme/css/App.css" type="text/css" />
    <link rel="stylesheet" href="admin_template/Theme/css/Login.css" type="text/css" />

    <link rel="stylesheet" href="admin_template/Theme/css/custom.css" type="text/css" />

</head>
<html>

<body>

    <h2>Add Admin</h2>
    <a href="dashboard.php">Get back to the Dashboard</a>

    <form method="post" action="">
        Name:<br>
        <input type="text" name="admin_name" required>
        <br>
        Surname:<br>
        <input type="text" name="admin_surname" required>
        <br>
        Username:<br>
        <input type="text" name="admin_username" required>
        <br>
        Password:<br>
        <input type="password" name="admin_pass" required>
        <br>
        Admin Status:<br>
        <input type="checkbox" name="admin_status">
        <br><br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>