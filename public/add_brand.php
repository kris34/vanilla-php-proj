<?php
include "header.php";
include '../src/Brand.php';

$brand = new Brand();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['brand_name'] ?? '';
    $image = $_POST['brand_image'] ?? '';
    $rating = $_POST['rating'] ?? '';

    if ($name && $image && $rating) {
        $success = $brand->create_brand($name, $image, $rating);

        if ($success === 'exists') {
            $message = "Brand already exists!";
        } elseif ($success) {
            $message = "Brand added successfully!";
        } else {
            $message = "Failed to add brand.";
        }
    } else {
        $message = "Please fill in all fields.";
    }
}

?>


<div class="wrapper">
    <div class="add-brand-wrapper">
        <h2 class="top-list-title">Add a Brand</h2>
        <form class="add-brand-form" method="POST">
            <div class="input-wrapper">
                <label>🏷️ Brand Name</label>
                <input name="brand_name" placeholder="e.g., Nike" />
            </div>
            <div class="input-wrapper">
                <label>🖼️ Brand Image URL</label>
                <input name="brand_image" placeholder="Paste image URL" />
            </div>
            <div class="input-wrapper">
                <label>⭐ Rating</label>
                <select name="rating">
                    <option value="" disabled selected>Choose rating</option>
                    <option value="1">1 ⭐</option>
                    <option value="2">2 ⭐⭐</option>
                    <option value="3">3 ⭐⭐⭐</option>
                    <option value="4">4 ⭐⭐⭐⭐</option>
                    <option value="5">5 ⭐⭐⭐⭐⭐</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Add Brand</button>
        </form>

        <?php if (!empty($message)) echo "<p>$message</p>"; ?>
    </div>
</div>