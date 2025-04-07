<?php
session_start();
include 'db.php';

// Image upload handling
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['product_images'])) {
    $errors = [];
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 1 * 1024 * 1024; // 1MB max file size
    $product_images = [];

    // Validate images
    for ($i = 0; $i < count($_FILES['product_images']['name']); $i++) {
        $image_name = $_FILES['product_images']['name'][$i];
        $image_type = $_FILES['product_images']['type'][$i];
        $image_size = $_FILES['product_images']['size'][$i];
        $image_tmp_name = $_FILES['product_images']['tmp_name'][$i];

        if ($image_size > $max_size) {
            $errors[] = "Image $image_name exceeds the 1MB size limit.";
        }
        if (!in_array($image_type, $allowed_types)) {
            $errors[] = "Invalid file type for $image_name.";
        }

        // Save image
        $image_path = 'uploads/' . uniqid() . '_' . $image_name;
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            $product_images[] = $image_path;
        } else {
            $errors[] = "Failed to upload image $image_name.";
        }
    }

    if (empty($errors)) {
        // Insert product info into DB
        $name = $conn->real_escape_string(trim($_POST['name']));
        $price = $conn->real_escape_string(trim($_POST['price']));
        $location = $conn->real_escape_string(trim($_POST['location']));

        $conn->query("INSERT INTO products (name, price, location, image_1, image_2, image_3, upload_date)
                      VALUES ('$name', '$price', '$location', '{$product_images[0]}', '{$product_images[1]}', '{$product_images[2]}', NOW())");
        echo "Product uploaded successfully!";
    } else {
        echo implode("<br>", $errors);
    }
}
?>
<link rel="stylesheet" href="style.css">
<div class="logo-container" style="text-align: center; margin: 20px 0;">
        <img src="sokolima_logo.svg" alt="SokoLima Logo" style="width: 220px;">
    </div>

<form method="POST" enctype="multipart/form-data">
    <h2>Upload Product</h2>
    <input type="text" name="name" required placeholder="Product Name"><br>
    <input type="text" name="price" required placeholder="Price"><br>
    <input type="text" name="location" required placeholder="Location"><br>
    <input type="file" name="product_images[]" accept="image/*" multiple><br>
    <button type="submit">Upload Product</button>
</form>
