<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуги</title>
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
        .slider {
            position: relative;
            width: 100%;
            overflow: hidden;
        }
        .slider img {
            width: 100%;
            display: none;
        }
        .slider img.active {
            display: block;
        }
        .slider-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }
        .slider-nav button {
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            color: #fff;
            padding: 10px;
            cursor: pointer;
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
        <div class="slider">
            <img src="images\image1.jpg" class="active" alt="Слайд 1">
            <img src="images\image2.jpg" alt="Слайд 2">
            <img src="images\image3.jpg" alt="Слайд 3">
            <img src="images\image4.jpg" alt="Слайд 4">
            <img src="images\image5.jpg" alt="Слайд 5">
            <img src="images\image6.jpg" alt="Слайд 6">
            <img src="images\image7.jpg" alt="Слайд 7">
            <img src="images\image8.jpg" alt="Слайд 8">
            <div class="slider-nav">
                <button onclick="prevSlide()">Назад</button>
                <button onclick="nextSlide()">Вперед</button>
            </div>
        </div>
    </div>
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider img');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        setInterval(nextSlide, 2000);
    </script>
</body>
</html>
