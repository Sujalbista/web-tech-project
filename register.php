<?php

include 'functions.php';
session_start();
$response = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (registerUser($username, $email, $password)) {
        $response = 'Registration successful.';
    } else {
        $response = 'Registration failed. Please try again.';
    }
    echo $response;
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - 4am Restaurant</title>
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
        <section id="register">
            <h1>Register</h1>
            <form id="registration-form">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
                <button type="submit">Register</button>
            </form>
            <div id="form-response"></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 4am Restaurant. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('registration-form').addEventListener('submit', function (event) {
            event.preventDefault();

            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm-password').value;

            if (password !== confirmPassword) {
                document.getElementById('form-response').innerText = 'Passwords do not match.';
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'register.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('form-response').innerText = xhr.responseText;
                    if (xhr.responseText === 'Registration successful.') {
                        document.getElementById('registration-form').reset();
                    }
                }
            };
            var formData = new FormData(document.getElementById('registration-form'));
            var encodedData = new URLSearchParams(formData).toString();
            xhr.send(encodedData);
        });
    </script>
</body>

</html>