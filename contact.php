<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Где нас найти?</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .logo {
            width: 64px;
            height: 64px;
        }
        .menu {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
        }
        .menu a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
        }
        .content {
            margin-top: 50px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu">
            <img src="images\logo.jpg" alt="Логотип" class="logo">
            <nav>
                <a href="about.php">О нас</a>
                <a href="services.php">Услуги</a>
                <a href="contact.php">Где нас найти?</a>
            </nav>
            <div>
                <a href="profile.php" class="btn">Личный кабинет</a>
            </div>
        </div>
        <div class="content">
            <h2>Контактные данные</h2>
            <p>Юридический адрес: Г.Колпино, СПб ГБПОУ "Ижорский политехнический колледж"</p>
            <p>Телефон: +7 (900) 622-96-45</p>
            <p>Электронная почта: flavianov2006@yandex.ru</p>
            <p>Социальные сети: <a href="https://vk.com/wooftwinkl">ВК</a>, <a href="https://t.me/BLWOOF">ТГ</a></p>
        </div>
    </div>
</body>
</html>
