<?php

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if (empty($phone) || empty($password)) {
        $error = "заполните пустые поля";
    } else {
        $sql = "SELECT * FROM User WHERE phone='$phone' AND password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            header("Location: animation.php");
            exit();
        } else {
            $error = "номер телефона не зарегистрирован или неверно введён пароль";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Serif', serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #4682b4;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e8491d 3px solid;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        header ul {
            padding: 0;
            list-style: none;
        }
        header li {
            display: inline;
            padding: 0 20px 0 20px;
        }
        header #branding {
            float: left;
        }
        header #branding img {
            height: 64px;
            width: 64px;
        }
        header nav {
            float: right;
            margin-top: 10px;
        }
        .main-form {
            margin-top: 50px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .main-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .main-form input[type="text"], .main-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .main-form input[type="submit"] {
            background: #4682b4;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .main-form input[type="submit"]:hover {
            background: #3a6ea5;
        }
        .main-form a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #4682b4;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <img src="logo.png" alt="Логотип">
            </div>
            <nav>
                <ul>
                    <li><a href="about.php">О нас</a></li>
                    <li><a href="audio.php">Аудиозаписи</a></li>
                    <li><a href="contact.php">Где нас найти?</a></li>
                    <li><a href="register.php">Регистрация</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <div class="main-form">
            <h2>Авторизация</h2>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <form action="login.php" method="POST">
                <input type="text" name="phone" placeholder="Телефон">
                <input type="password" name="password" placeholder="Пароль">
                <input type="submit" value="Войти">
            </form>
            <a href="register.php">Зарегистрироваться</a>
        </div>
    </div>
</body>
</html>