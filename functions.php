<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function registerUser($username, $email, $password) {
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    return $stmt->execute();
}


function loginUser($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            return true;
        }
    }

    return false;
}


function getMenuItems() {
    global $conn;

    $sql = "SELECT category, dish, description, price, image FROM menu_items";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error: " . $conn->error;
        return [];
    }

    $menuItems = [];
    while ($row = $result->fetch_assoc()) {
        $menuItems[] = $row;
    }

    return $menuItems;
}


function addReservation($name, $email, $phone, $date, $time, $guests, $special_requests) {
    global $conn;

    $sql = "INSERT INTO reservations (name, email, phone, date, time, guests, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssis", $name, $email, $phone, $date, $time, $guests, $special_requests);

    return $stmt->execute();
}

function addContactMessage($name, $email, $message) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    return $stmt->execute();
}


function logoutUser() {
    session_destroy();
    header("Location: login.html");
    exit();
}
function getFeaturedMenuItems() {
    global $conn;
    $sql = "SELECT dish, image FROM menu_items WHERE is_featured = 1";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}



?>
