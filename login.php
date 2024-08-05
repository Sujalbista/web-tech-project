<?php

include 'functions.php';
session_start();
$response = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (loginUser($username, $password)) {
            $response = 'Login successful.';
        } else {
            $response = 'Login failed. Invalid username or password.';
        }
    } else {
        $response = 'Please fill in both fields.';
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
    <title>Login - 4am Restaurant</title>
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
        <section id="login">
            <h1>Login</h1>
            <form id="login-form" method="POST">
                <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <div id="form-response"></div>
        </section>
    </main>
    
        
        
        
        
        
    </form>
    <footer>
        <p>&copy; 2024 4am Restaurant. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('login-form').addEventListener('submit', function (event) {
            event.preventDefault();

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'login.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('form-response').innerText = xhr.responseText;
                    if (xhr.responseText === 'Login successful.') {
                        window.location.href = 'index.php'; 
                    }
                }
            };
            var formData = new FormData(document.getElementById('login-form'));
            var encodedData = new URLSearchParams(formData).toString();
            xhr.send(encodedData);
        });
    </script>
    
</body>

</html>