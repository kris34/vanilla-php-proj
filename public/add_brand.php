<?php include "header.php"; ?>

<div class="wrapper">
    <div class="add-brand-wrapper">
        <h2 class="top-list-title">Add a Brand</h2>
        <form class="add-brand-form">
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

            <button type="submit" class="submit-btn">➕ Add Brand 🎉</button>
        </form>
    </div>
</div>