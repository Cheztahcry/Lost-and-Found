<?php
session_start();
$item_table = true;
$item_rows = null;
$missing_row = null;
$found_row = null;
$user = false;
try {
    if(isset($_SESSION["user_id"])){
    include_once  'owner_info_class.php';
    include_once __DIR__ . '/item_class.php';
    $owner = new OwnerInfo();
    $user = $owner->show_ownerinfo($_SESSION["user_id"]);
    if (class_exists('ItemInfo')){
        $item = new ItemInfo();
        $item_rows = $item->show_item_info();
        $missing_row = $item->specific_type("Missing");
        $found_row = $item->specific_type("Found");
    }
    


}
}catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    
</head>
<body>
<header>
    <div class="logo_row">
        <img src="assets/img/logo.png" class="logo" alt="Subdivision Logo">
        <a href="index.php" class="brand-title">LNF</a>
    </div>
    <div class="header-links">
        <?php if($user):?>
            <a href="owner_dashboard.php" class="user_greet">
                <?php if(!empty($user->picture)): ?>
                    <img src="assets/img/uploads/<?= htmlspecialchars($user->picture) ?>" alt="Profile" class="user-avatar" style="width:30px;height:30px;border-radius:50%;object-fit:cover;">
                <?php else: ?>
                    <span class="user-icon" aria-hidden="true">👤</span>
                <?php endif; ?>
                <span>Hello, <?= htmlspecialchars($user->fname) ?>!</span>
            </a>
            <div class="action-group">
                <a href="item.php" class="signin-btn">FILE A REPORT</a>
                <a href="logout.php" class="signin-btn">LOG OUT</a>
            </div>
        <?php else:?>
            <div class="action-group">
                <a href="item.php" class="signin-btn">FILE A REPORT</a>
                <a href="login.php" class="signin-btn">LOG IN</a>
                <a href="owner_info.php" class="signin-btn">REGISTER</a>
            </div>
        <?php endif;?>
    </div>
</header>
    <div class = "options">
        <div class="status-toggle">
            <label class="status-option">
                <input type="radio" name="property_status" id= "sale-radio" value="sale">
                <span>Missing</span>
            </label>
            <label class="status-option">
                <input type="radio" name="property_status" id= "rent-radio" value="rent">
                <span>Found</span>
            </label>
        </div>

        <div class="search-field">
            <span class="search-icon" aria-hidden="true"></span>
            <input type="text" name="search_bar" id="search_bar" class="search-input" placeholder="Search by type, brand or ID...">
        </div>
        <button type="button" class="option-btn search-btn">Search</button>
        <button type="button" class="option-btn filter-btn">Filter</button>
        <div class="filter-group hidden">
                <div class="filter-header">
                    <span>Sort &amp; filter</span>
                </div>
                <div class="filter-controls">
                    <div class="filter-control">
                        <label class="visually-hidden" for="sort_by">Sort by</label>
                        <select name="sort_by" id="sort_by" class="filter-select">
                            <option value="block">Item Type</option>
                            <option value="lot">Brand</option>
                        </select>
                    </div>
                    <div class="filter-control">
                        <label class="visually-hidden" for="sort_order">Sort order</label>
                        <select name="sort_order" id="sort_order" class="filter-select">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>

                </div>           
        </div>
    </div>
    <div id = "search-results">
        
    </div>
    <div class = "missing-dashboard" id = "missing-dashboard">
        <div class = "dashboard-container">
        
            <table>
            <thead>
            <tr>
                <th>Item ID</th>
                <th>Item Type</th>
                <th>Item Brand</th>
                <th>Item Color</th>
                <th>Item Image </th>
                <th>Report Type</th>
            </tr>
            </thead>
            <tbody>
                <?php if ($missing_row && count($missing_row) > 0): ?>
                <?php foreach ($missing_row as $row): ?>            
                <tr>
                    <td><?= htmlspecialchars($row->id) ?></td>
                    <td><?= htmlspecialchars($row->item_type) ?></td>
                    <td><?= htmlspecialchars($row->item_brand) ?></td>
                    <td><?= htmlspecialchars($row->item_color) ?></td>
                    <td><?= htmlspecialchars($row->item_image) ?></td>
                    <td><?= htmlspecialchars($row->report_type) ?></td>
                </tr>
                        <button type="button" class="action-btn contact-btn">Contact</button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
                            <strong>No properties are currently available.</strong><br>
                            Please try refreshing the page or check back later.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
                </table>
        </div>
        
    </div>
        </tbody>
        </table>
    </div>
    <footer>
        <p>© 2026 LNF by C.J.C. All rights reserved.</p>
    </footer>
    <script src="js/index.js" defer></script>
    <script src="js/jquery.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>