<?php

include 'functions.php';
session_start();
$menuItems = getMenuItems();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Restaurant Name</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .price {
            font-weight: bold;
            color: #333;
        }

        .dish-img {
            width: 100px;
            height: 75px;
            object-fit: cover;
        }
    </style>
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
        <section id="menu">
            <h1>Our Menu</h1>
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Dish</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2">Appetizers</td>
                        <td>Bruschetta</td>
                        <td>Toasted bread with tomato, basil, and garlic.</td>
                        <td class="price">$8.99</td>
                        <td><img src="images/bruschetta.jpg" alt="Bruschetta" class="dish-img"></td>
                    </tr>
                    <tr>
                        <td>Stuffed Mushrooms</td>
                        <td>Mushrooms filled with cheese and herbs.</td>
                        <td class="price">$9.99</td>
                        <td><img src="images/stuffedmushrooms.jpg" alt="Stuffed Mushrooms" class="dish-img"></td>
                    </tr>
                    <tr>
                        <td rowspan="2">Main Courses</td>
                        <td>Grilled Salmon</td>
                        <td>Fresh salmon grilled to perfection with lemon and herbs.</td>
                        <td class="price">$15.99</td>
                        <td><img src="images/grilledsalmon.jpg" alt="Grilled Salmon" class="dish-img"></td>
                    </tr>
                    <tr>
                        <td>Chicken Alfredo</td>
                        <td>Creamy Alfredo sauce with grilled chicken and fettuccine pasta.</td>
                        <td class="price">$14.99</td>
                        <td><img src="images/chickenalfredo.jpg" alt="Chicken Alfredo" class="dish-img"></td>
                    </tr>
                    <tr>
                        <td rowspan="2">Desserts</td>
                        <td>Tiramisu</td>
                        <td>A classic Italian dessert with coffee-soaked ladyfingers and mascarpone cheese.</td>
                        <td class="price">$6.99</td>
                        <td><img src="images/tiramisu.jpg" alt="Tiramisu" class="dish-img"></td>
                    </tr>
                    <tr>
                        <td>Cheesecake</td>
                        <td>Rich and creamy cheesecake with a graham cracker crust.</td>
                        <td class="price">$7.99</td>
                        <td><img src="images/cheesecake.jpg" alt="Cheesecake" class="dish-img"></td>
                        <?php if (!empty($menuItems)): ?>
                        <?php
                        $currentCategory = '';
                        foreach ($menuItems as $item):
                            if ($item['category'] !== $currentCategory):
                                if ($currentCategory !== ''): ?>
                                    </tr>
                                <?php endif;
                                $currentCategory = $item['category']; ?>
                                <tr>
                                    <td rowspan="<?php echo array_sum(array_column(array_filter($menuItems, function($e) use ($currentCategory) { return $e['category'] == $currentCategory; }), 'count')); ?>"><?php echo htmlspecialchars($currentCategory); ?></td>
                            <?php endif; ?>
                            <td><?php echo htmlspecialchars($item['dish']); ?></td>
                            <td><?php echo htmlspecialchars($item['description']); ?></td>
                            <td class="price"><?php echo htmlspecialchars($item['price']); ?></td>
                            <td><img src="images/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['dish']); ?>" class="dish-img"></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No menu items available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Restaurant Name. All rights reserved.</p>
    </footer>
</body>

</html>