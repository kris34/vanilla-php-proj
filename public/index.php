<?php
include '../src/Brand.php';

$brand = new Brand();
$userCountry = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'XX';
$message = '';
$editId = isset($_GET['edit_id']) ? (int)$_GET['edit_id'] : null;

if (isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];
    $result = $brand->delete_brand($deleteId);
    $message = $result['message'] ?? 'Action completed';
    header("Location: index.php");
    exit;
}

if (isset($_POST['save_id'])) {
    $saveId = (int)$_POST['save_id'];
    $name = trim($_POST['edit_name'] ?? '');
    $image = trim($_POST['edit_image'] ?? '');
    $rating = (int)($_POST['edit_rating'] ?? 0);

    $result = $brand->update_brand($saveId, $name, $image, $rating);
    $message = $result['message'] ?? 'Action completed';

    header("Location: index.php");
    exit;
}

$showAll = isset($_GET['show_all']) && $_GET['show_all'] == '1';
$brands = $showAll ? $brand->get_brands() : $brand->get_brands($userCountry);

include 'header.php';
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
                    <th>⚙️ Action</th>
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
                            <?php if ($editId === (int)$b['id']): ?>
                                <form method="post" style="margin:0;">
                                    <td data-label="🏷️ Brand"><input type="text" name="edit_name" value="<?php echo htmlspecialchars($b['brand_name']); ?>" required></td>
                                    <td data-label="🖼️ Logo"><input type="text" name="edit_image" value="<?php echo htmlspecialchars($b['brand_image']); ?>" required></td>
                                    <td data-label="⭐ Rating"><input type="number" name="edit_rating" value="<?php echo (int)$b['rating']; ?>" min="1" max="5" required></td>
                                    <td data-label="🌍 Country"><?php echo htmlspecialchars($countryLabel); ?></td>
                                    <td data-label="⚙️ Action" class="actions-wrap">
                                        <input type="hidden" name="save_id" value="<?php echo (int)$b['id']; ?>">
                                        <button type="submit" class="btn-save">💾 Save</button>
                                        <a class="btn-cancel" href="index.php<?php echo $showAll ? '?show_all=1' : ''; ?>">❌ Cancel</a>
                                    </td>
                                </form>

                            <?php else: ?>
                                <td data-label="🏷️ Brand"><?php echo htmlspecialchars($b['brand_name']); ?></td>
                                <td data-label="🖼️ Logo">
                                    <img src="<?php echo htmlspecialchars($b['brand_image']); ?>"
                                        alt="<?php echo htmlspecialchars($b['brand_name']); ?>" width="50" />
                                </td>
                                <td data-label="⭐ Rating"><?php echo str_repeat('⭐', (int)$b['rating']); ?></td>
                                <td data-label="🌍 Country"><?php echo htmlspecialchars($countryLabel); ?></td>
                                <td data-label="⚙️ Action" class="actions-wrap">
                                    <a href="index.php?edit_id=<?php echo (int)$b['id']; ?><?php echo $showAll ? '&show_all=1' : ''; ?>" class="btn-edit">✏️ Edit</a>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="delete_id" value="<?php echo (int)$b['id']; ?>">
                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this brand?');">🗑️ Delete</button>
                                    </form>
                                </td>
                            <?php endif; ?>
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