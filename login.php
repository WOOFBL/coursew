<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <div class="container">
    <header>
    <div class="menu">
            <img src="images\logo.jpg" alt="Логотип" class="logo">
            <nav>
                <a href="about.php">О нас</a>
                <a href="services.php">Услуги</a>
                <a href="contact.php">Где нас найти?</a>
            </nav>
            <div>
                <a href="login.php" class="btn">Авторизация</a>
                <a href="register.php" class="btn">Регистрация</a>
            </div>
        </div>
    </div>
    </header>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            display: block;
            width: 100%;
            margin: 0 auto;
            align-items: center;
            justify-content: center;

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
        .auth-container {
           
            width: 30%;
            margin: 0 auto;
            margin-top: 50px;
            background-color: #fff;
            padding: 20px;
            
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .auth-container h2 {
            margin-bottom: 20px;
        }
        .auth-container input {
            width: 50%;
            padding: 10px;
            margin: 10px auto;
            align-items: center;
            justify-content: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
        }
        .auth-container button {
            display: block;
            width: 40%;
            margin: auto auto;
            margin-top: 30px;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    
</head>
<body>
<div class="container">
        <div class="auth-container">
            <h2>Авторизация</h2>
            <form id="loginForm" method="POST" action="login.php">
                <input type="phone" name="phone" placeholder="Phone" maxlength="12" minlength="11" pattern="[+]7\s[\(]\d{3}[\)]\s\d{3}[\-]\d{2}[\-]\d{2}">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
        </div>
</body>


<?php
require_once('db.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Проверка на пустые поля
    if (empty($phone) || empty($password)) {
        echo "Заполните пустые поля";
    } else {
        // Проверка данных пользователя
        $sql = "SELECT * FROM woof WHERE phone='$phone' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            header("Location: animation.php");
        } else {
            echo "Неверный номер телефона или пароль";
        }
    }
}

?>
