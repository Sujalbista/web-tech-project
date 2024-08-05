<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = isset($_GET['type']) ? $_GET['type'] : 'featured';

if ($type === 'featured') {
    $sql = "SELECT dish, description, image FROM menu_items WHERE is_featured = 1";
} elseif ($type === 'menu') {
    $sql = "SELECT category, dish, description, price FROM menu_items ORDER BY category";
} else {
    echo "Invalid type specified.";
    $conn->close();
    exit();
}

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$featuredDishes = [];
if ($result->num_rows > 0) {
    $featuredDishes = $result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4am Restaurant</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="reservations.php">Reservations</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="intro">
            <h1>Welcome to 4am Restaurant</h1>
            <p>Where Taste Meets Tradition</p>
        </section>
        <section id="featured-dishes">
            <h1>Featured Dishes</h1>
            <div class="slider">
                <div class="slider-images">
                    <div class="slide">
                        <img src="images/momo.jpg" alt="Momo">
                    </div>
                    <div class="slide">
                        <img src="images/pizza.jpeg" alt="Pizza">
                    </div>
                    <div class="slide">
                        <img src="images/burger.jpg" alt="Burger">
                    </div>
                    <?php
                    foreach ($featuredDishes as $dish) {
                        echo "<div class='slide'>";
                        echo "<img src='" . $dish["image"] . "' alt='" . $dish["name"] . "'>";
                        echo "</div>";
                    }
                    
                    foreach ($featuredMenuItems as $item) {
                        echo "<div class='slide'>";
                        echo "<img src='" . $item["image"] . "' alt='" . $item["name"] . "'>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <button class="prev" onclick="prevSlide()">&#10094;</button>
                <button class="next" onclick="nextSlide()">&#10095;</button>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 4am Restaurant. All rights reserved.</p>
    </footer>

    <script>
        let slideIndex = 0;

        function showSlide(index) {
            const slides = document.querySelectorAll('.slide');
            const totalSlides = slides.length;

            if (index >= totalSlides) slideIndex = 0;
            if (index < 0) slideIndex = totalSlides - 1;

            const sliderImages = document.querySelector('.slider-images');
            sliderImages.style.transform = `translateX(-${slideIndex * 100}%)`;
        }

        function nextSlide() {
            slideIndex++;
            showSlide(slideIndex);
        }

        function prevSlide() {
            slideIndex--;
            showSlide(slideIndex);
        }

        showSlide(slideIndex);
        setInterval(nextSlide, 5000);
    </script>
</body>

</html>
