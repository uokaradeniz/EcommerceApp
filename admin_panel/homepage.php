<?php
include 'db_connect.php';

// Kategorileri veritabanından çek
$sql = "SELECT category_id, category_name FROM category_table";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa - UOKBurada</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Ekstra stiller */
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            /* Kategorileri ortala */
        }

        nav li {
            margin: 0 10px;
        }

        nav select {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
        }

        nav select option {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="homepage.php">Ana Sayfa</a></li>
                <!-- Dropdown menü -->
                <li>
                    <select onchange="location = this.value;">
                        <option value="">Kategori Seç</option>
                        <?php
                        $sql = "SELECT category_id, category_name FROM category_table";
                        $result_categories = $conn->query($sql);

                        if ($result_categories->num_rows > 0) {
                            while ($row = $result_categories->fetch_assoc()) {
                                echo '<option value="category.php?category_id=' . $row["category_id"] . '">' . $row["category_name"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Kategori bulunamadı</option>';
                        }
                        ?>
                    </select>
                </li>
                <li><a href="cart.php">Sepetim</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>UOKBurada E-Commerce</h1>
        <img src="uploads/homepage.jpeg">

        <h2>Hoş Geldiniz!</h2>
        <p>En iyi ürünleri en uygun fiyatlarla satın alın.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin condimentum, erat in scelerisque fermentum, quam nulla venenatis neque, eget pretium tellus tortor id mauris. Duis vitae suscipit ipsum, quis facilisis erat. Phasellus consectetur nulla ac lorem tincidunt ullamcorper. In dolor orci, rutrum sed tincidunt in, faucibus et diam. Fusce consequat sollicitudin quam, a ornare ante semper ultrices. Praesent pretium dui a justo varius volutpat. Cras odio elit, molestie et blandit vel, congue a elit. Donec elementum convallis lectus quis malesuada. Integer venenatis sodales leo, ut mattis magna aliquet et. Phasellus et sem est. Morbi cursus elementum turpis, ac eleifend purus suscipit ut. Etiam at imperdiet purus. Mauris ac magna sollicitudin, luctus tellus et, commodo dolor. Fusce suscipit nec nulla sit amet molestie.</p>
        <img src="uploads/homepage2.jpeg">
        <p>Aenean vel gravida turpis. Nullam aliquet placerat diam in aliquet. Etiam pharetra purus nisl, non iaculis ex dignissim id. Donec risus dolor, tempor quis consequat at, placerat sit amet leo. Nam dignissim lacus eu nulla euismod, vel rutrum nisl accumsan. Nullam condimentum a lacus pharetra rutrum. Sed libero lectus, aliquet sed fringilla vel, scelerisque eu elit. Morbi id diam congue, vestibulum dui quis, imperdiet turpis. Vivamus euismod ante rhoncus neque posuere placerat. Nullam ut pulvinar libero. Pellentesque pharetra pharetra magna a laoreet. Duis auctor erat at lectus vestibulum volutpat. Fusce aliquam est id posuere vulputate.</p>
    </main>
    <footer>
        <p>2024 UOKBurada.com</p>
    </footer>
</body>

</html>

<?php
$conn->close();
?>