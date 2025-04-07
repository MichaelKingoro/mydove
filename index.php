<?php
// index.php - Main landing page for SokoLima
session_start();
include 'db.php';

// Auto-delete products older than 60 days
$conn->query("DELETE FROM products WHERE upload_date < DATE_SUB(NOW(), INTERVAL 60 DAY)");
?>

<!DOCTYPE html>
<html>
<head>
    <title>SokoLima</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="logo-container" style="text-align: center; margin: 20px 0;">
        <img src="sokolima_logo.svg" alt="SokoLima Logo" style="width: 220px;">
    </div>

    <h2>SokoLima - Your new agricultural produce marketplace</h2>
	
    
	<div class="nav" id="navbar">
        <a href="index.php" class="active">Home</a>
        <?php if(isset($_SESSION['seller_id'])): ?>
            <a href="upload.php">Upload Product</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        <?php endif; ?>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="javascript:void(0);" class="icon" onclick="toggleNav()">
            &#9776;
        </a>
    </div>

    <script>
        function toggleNav() {
            var x = document.getElementById("navbar");
            if (x.className === "nav") {
                x.className += " responsive";
            } else {
                x.className = "nav";
            }
        }
    </script>
	
	
	

    <form method="GET">
        <input type="text" name="search" placeholder="Search products...">
        <select name="sort">
            <option value="">Sort By</option>
            <option value="price">Price</option>
            <option value="location">Location</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <div class="products">
        <?php
        $query = "SELECT * FROM products";
        if (!empty($_GET['search'])) {
            $search = $conn->real_escape_string($_GET['search']);
            $query .= " WHERE name LIKE '%$search%'";
        }
        if (!empty($_GET['sort'])) {
            $sort = $_GET['sort'];
            if (in_array($sort, ['price', 'location'])) {
                $query .= strpos($query, 'WHERE') !== false ? " ORDER BY $sort" : " ORDER BY $sort";
            }
        }
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>
                    <h3>{$row['name']}</h3>
                    <p>Price: {$row['price']}</p>
                    <p>Location: {$row['location']}</p>";
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($row["image_$i"])) {
                    echo "<img src='uploads/{$row["image_$i"]}' style='max-width:200px;'><br>";
                }
            }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
