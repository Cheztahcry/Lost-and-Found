<?php
session_start();
include_once 'item_info_class.php';
$item = new ItemInfo();
$rows = $item->show_item_info();
$user = false;
if(isset($_SESSION["user_id"])){
    include_once  'user_info_class.php';
    $user_info = new OwnerInfo();
    $user = $user_info->show_ownerinfo($_SESSION["user_id"]);
    


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
            <span class="user_greet">HELLO, <?= htmlspecialchars($user->fname) ?></span>
            <div class="action-group">
                <a href="rent_info.php" class="signin-btn">MISSING AN ITEM?</a>
                <a href="rent_info.php" class="signin-btn">FOUND AN ITEM!</a>
                <a href="logout.php" class="signin-btn">LOG OUT</a>
            </div>
        <?php else:?>
            <div class="action-group">
                <a href="rent_info.php" class="signin-btn">MISSING AN ITEM</a>
                <a href="rent_info.php" class="signin-btn">FOUND AN ITEM</a>
                <a href="login.php" class="signin-btn">LOG IN</a>
                <a href="user_info.php" class="signin-btn">REGISTER</a>
            </div>
        <?php endif;?>
    </div>
</header>
    <div class = "dashboard-container">
        
        <table>
        <thead>
        <tr>
            <th>Item ID</th>
            <th>Item Type</th>
            <th>Item Name</th>
            <th>Item Image</th>
            <th>Date</th>


    </tr>
    <tbody>
        <?php if ($rows): ?>
        <?php foreach ($rows as $row): ?>
        
                
                        <tr>
                        <td><?= $row->item_id ?></td>
                        <td><?= $row->item_type ?></td>
                        <td><?= $row->item_name ?></td>
                        <td><?= $row->item_img ?></td>
                        <td><?= $row->date ?></td>
                        </tr>
                
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        </table>
        
</body>
</div>
 <footer>
        <p>© 2026 LNF by C.J.C. All rights reserved.</p>
    </footer>
</body>
</html>