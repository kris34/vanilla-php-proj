<?php
include 'header.php';
include '../src/Brand.php';

$brand = new Brand();
$userCountry = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'XX';
$message = '';

if (isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];
    $result = $brand->delete_brand($deleteId);
    $message = $result['message'] ?? 'Action completed';
}

$showAll = isset($_GET['show_all']) && $_GET['show_all'] == '1';
$brands = $showAll ? $brand->get_brands() : $brand->get_brands($userCountry);
?>

<div class="wrapper">
    <div class="home-wrapper">
        <h2 class="top-list-title">Welcome to Top List!</h2>
        <div class="home-desc-wrapper">
            <p>🌍📱 Discover the best brands from around the world, complete with ratings, images, and reviews ⭐🖼️.</p>
        </div>

        <?php if (!empty($message)): ?>
            <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <table cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>🏷️ Brand</th>
                    <th>🖼️ Logo</th>
                    <th>⭐ Rating</th>
                    <th>🌍 Country</th>
                    <th>🗑️ Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($brands)): ?>
                    <?php foreach ($brands as $b): ?>
                        <?php
                        $isLocal = ($b['country'] ?? 'XX') === $userCountry;
                        $rowClass = $isLocal ? 'local-brand' : '';
                        $countryLabel = $isLocal ? $b['country'] . ' 🌍' : $b['country'] ?? 'XX';
                        ?>
                        <tr class="<?php echo $rowClass; ?>">
                            <td data-label="🏷️ Brand"><?php echo htmlspecialchars($b['brand_name']); ?></td>
                            <td data-label="🖼️ Logo">
                                <img src="<?php echo htmlspecialchars($b['brand_image']); ?>"
                                    alt="<?php echo htmlspecialchars($b['brand_name']); ?>"
                                    width="50" />
                            </td>
                            <td data-label="⭐ Rating"><?php echo str_repeat('⭐', (int)$b['rating']); ?></td>
                            <td data-label="Country"><?php echo htmlspecialchars($countryLabel); ?></td>
                            <td data-label="🗑️ Action">
                                <form method="post" style="margin:0;">
                                    <input type="hidden" name="delete_id" value="<?php echo (int)$b['id']; ?>">
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this brand?');">
                                        Delete 🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No brands found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if ($showAll): ?>
            <a href="index.php" class="btn">Show Local Brands 🌍</a>
        <?php else: ?>
            <a href="index.php?show_all=1" class="btn">Show All Brands 🌐</a>
        <?php endif; ?>
    </div>
</div>