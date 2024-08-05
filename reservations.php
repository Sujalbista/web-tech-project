
<?php

include 'functions.php';

session_start();

$responseMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    $special_requests = isset($_POST['special_requests']) ? $_POST['special_requests'] : '';

    if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($time) || empty($guests)) {
        $responseMessage = "All fields are required.";
    } else {
        $result = addReservation($name, $email, $phone, $date, $time, $guests, $special_requests);

        if ($result) {
            $responseMessage = "Your reservation has been made successfully.";
        } else {
            $responseMessage = "Sorry, there was an error making your reservation. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations - 4am Restaurant</title>
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
        <section id="reservations">
            <h1>Make a Reservation</h1>
            <form id="reservation-form" method="post" action="reservations.php">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time" required>
                </div>
                <div class="form-group">
                    <label for="guests">Number of Guests:</label>
                    <input type="number" id="guests" name="guests" min="1" required>
                </div>
                <button type="submit">Reserve</button>
            </form>
            <div id="form-response"></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 4am Restaurant. All rights reserved.</p>
    </footer>

  
</body>

</html>