<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim Bilgileri - UOKBurada</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-info {
            margin-bottom: 20px;
        }

        .contact-info p {
            margin-bottom: 10px;
        }

        .contact-info p:last-child {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
<header>
<nav>
            <h1>UOKBurada E-Commerce</h1><br>
            <ul>
                <li><a href="homepage.php">Ana Sayfa</a></li>
                <li> <img src="uploads/carts.png" style="max-width: 30px; height: auto;" alt="Sepet">
                    <a href="cart.php"> Sepet</a>
                </li>
                <li><a href="contact.php">İletişim</a></li>
                <li><a href="index.php" style="color: red;">Admin Panel (Debug)</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>İletişim Bilgileri</h1>
        <div class="contact-info">
            <p><strong>Adres:</strong> UOKBurada Plaza, No: 123, İstanbul, Türkiye, Ataaşehir</p>
            <p><strong>Telefon:</strong> +90 123 456 7890</p>
            <p><strong>E-posta:</strong> info@uokburada.com</p>
        </div>
        <p>Bizimle iletişime geçmek için yukarıdaki bilgileri kullanabilirsiniz.</p>
    </div>
</body>

</html>