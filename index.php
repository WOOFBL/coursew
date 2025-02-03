<?php
session_start();
$host = 'localhost';
$db = 'plehanova_331'; // Или 'cwp1_232' для группы 232c
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $agreement = isset($_POST['agreement']) ? 1 : 0;

        if (empty($phone) || empty($password) || empty($confirm_password) || !$agreement) {
            $error = "Заполните все поля и согласитесь с политикой";
        } elseif ($password !== $confirm_password) {
            $error = "Пароли не совпадают";
        } else {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
            $stmt->execute([$phone]);
            $user = $stmt->fetch();
            if ($user) {
                $error = "Этот номер телефона уже занят";
            } else {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (phone, password) VALUES (?, ?)");
                $stmt->execute([$phone, $password_hash]);
                header("Location: ?page=animation");
                exit;
            }
        }
    } elseif (isset($_POST['login'])) {
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        if (empty($phone) || empty($password)) {
            $error = "Заполните все поля";
        } else {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
            $stmt->execute([$phone]);
            $user = $stmt->fetch();
            if (!$user || !password_verify($password, $user['password'])) {
                $error = "Неверный номер телефона или пароль";
            } else {
                $_SESSION['user_id'] = $user['id'];
                header("Location: ?page=animation");
                exit;
            }
        }
    }
}

if (isset($_GET['page']) && $_GET['page'] == 'logout') {
    session_destroy();
    header("Location: ?page=home");
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаленный помощник</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Логотип">
        </div>
        <nav>
            <ul>
                <li><a href="?page=home">О нас</a></li>
                <li><a href="?page=services">Услуги</a></li>
                <li><a href="?page=contact">Где нас найти?</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="?page=profile">Личный кабинет</a></li>
                    <li><a href="?page=logout">Выйти</a></li>
                <?php else: ?>
                    <li><a href="?page=login">Авторизация</a></li>
                    <li><a href="?page=register">Регистрация</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($page == 'home'): ?>
            <h1>Русские горизонты</h1>
            <p>Открытие для себя России!</p>
        <?php elseif ($page == 'services'): ?>
            <div class="slider">
                <!-- Слайдер с изображениями -->
            </div>
        <?php elseif ($page == 'contact'): ?>
            <h1>Контактные данные</h1>
            <p>Юридический адрес: 123456, Россия, г. Москва, ул. Примерная, д. 1</p>
            <p>Телефон: +7 (123) 456-78-90</p>
            <p>Электронная почта: info@example.com</p>
            <p>Социальные сети: <a href="https://vk.com/example">ВК</a>, <a href="https://t.me/example">ТГ</a></p>
        <?php elseif ($page == 'register'): ?>
            <form method="POST">
                <h2>Регистрация</h2>
                <label for="phone">Телефон:</label>
                <input type="text" id="phone" name="phone" required>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
                <label for="confirm_password">Повторите пароль:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <label for="agreement">
                    <input type="checkbox" id="agreement" name="agreement" required>
                    Согласие с политикой обработки персональных данных
                </label>
                <button type="submit" name="register">Зарегистрироваться</button>
            </form>
        <?php elseif ($page == 'login'): ?>
            <form method="POST">
                <h2>Вход</h2>
                <label for="phone">Телефон:</label>
                <input type="text" id="phone" name="phone" required>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" name="login">Войти</button>
            </form>
        <?php elseif ($page == 'animation'): ?>
            <div class="animation">
                <!-- Анимация загрузки -->
                <meta http-equiv="refresh" content="5;url=?page=home">
            </div>
        <?php elseif ($page == 'profile'): ?>
            <h1>Личный кабинет</h1>
            <p>Добро пожаловать, пользователь!</p>
        <?php endif; ?>
    </main>
</body>
</html>
