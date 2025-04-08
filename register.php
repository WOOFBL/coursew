<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        menu.nav{
            margin: 0 auto;
            display: inline-block;
            justify-content: center;
            align-items: center;
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
        .form-container {
            width: 30%;
            display: block;
            margin: 0 auto;
            margin-top: 50px;
            background-color: #fff;
            padding: 20px;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container input {
            width: 50%;
            padding: 10px;
            margin: 10px auto;
            justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
        }
        .form-container h2{
            justify-content: left;
            align-items: center;
        }
        .form-container button {
            width: 50%;
            padding: 10px 20px;
            margin: 10px auto;
            margin-top: 50px    ;
            background-color: #333;
            color: #fff;
            justify-content: center;
            align-items: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
        }
        .checkbox{
            display: inline;
            justify-content: center;
            align-items: center;
            margin: auto auto;

        }
        .checkbox label{
            display: flex;
            margin: auto auto;
            justify-content: center;
            width: 90%;
            height: 30%;
            justify-content: center;
            align-items: center;

        }
        .checkbox input{
            display: flex;
            box-sizing: border-box;
            width: 15%;
            margin: auto 20px;
            justify-content: center;
            align-items: center;
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
                <a href="login.php" class="btn">Авторизация</a>
                <a href="register.php" class="btn">Регистрация</a>
            </div>
        </div>
        <div class="form-container">
            <h2>Регистрация</h2>
            <form action="register.php" method="POST">
                <input type="text" name="phone" placeholder="Телефон" maxlength="12" minlength="11" pattern="^\+7\s?[\(]\d{3}[\)]\s\d{3}[\-]\d{2}[\-]\d{2}" required>
                <input type="password" name="password" placeholder="Пароль" minlength="6" maxlength="12" required>
                <input type="password" name="confirm_password" placeholder="Повторите пароль" minlength="6" maxlength="12" required>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="agreement" required>
                        Согласие с политикой обработки персональных данных
                    </label>
                </div>
                <button type="submit">Зарегистрироваться</button>
            </form>
        </div>
    </div>
</body>
</html>


<?php
require_once('db.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $agreement = isset($_POST['agreement']) ? 1 : 0;

    if (empty($phone) || empty($password) || empty($confirm_password)) {
        echo "Заполните пустые поля";
    } elseif ($password != $confirm_password) {
        echo "Пароли не совпадают";
    } elseif (!$agreement) {
        echo "Необходимо согласиться с нашей политикой";
    } else {
        $sql = "SELECT * FROM woof WHERE phone='$phone'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Этот номер телефона уже занят";
        } else {
            $sql = "INSERT INTO woof (phone, password) VALUES ('$phone', '$password')";
            if ($conn->query($sql) === TRUE) {
                header("Location: animation.php");
            } else {
                echo "Ошибка: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>
