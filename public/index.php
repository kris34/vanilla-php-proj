<?php
include 'header.php';
include '../src/Brand.php';

$brand = new Brand();
$brands = $brand->get_brands();
?>


<div class="wrapper">
    <div class="home-wrapper">
        <h2 class="top-list-title">
            Welcome to Top List!
        </h2>
        <div class="home-desc-wrapper">
            <p>
                🌍📱 Discover the best brands from around the world, complete with ratings, images, and reviews ⭐🖼️.
        </div>

        <table cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>🏷️ Brand</th>
                    <th>🖼️ Logo</th>
                    <th>⭐ Rating</th>
                    <th>🌍 Country</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($brands)): ?>
                    <?php foreach ($brands as $b): ?>
                        <tr>
                            <td data-label="🏷️ Brand"><?php echo htmlspecialchars($b['brand_name']); ?></td>
                            <td data-label="🖼️ Logo">
                                <img src="<?php echo htmlspecialchars($b['brand_image']); ?>"
                                    alt="<?php echo htmlspecialchars($b['brand_name']); ?>"
                                    width="50" />
                            </td>
                            <td data-label="⭐ Rating"><?php echo str_repeat('⭐', (int)$b['rating']); ?></td>
                            <td data-label="Country"><?php echo htmlspecialchars($b['country'] ?? 'XX'); ?></td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No brands found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>



        </table>
    </div>
</div>