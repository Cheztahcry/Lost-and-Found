<?php
session_start();
include_once 'item_class.php';
$rent = new ItemInfo();
$rows = $rent->show_item_info();
$user = false;
if(isset($_SESSION["user_id"])){
    include_once  'owner_info_class.php';
    $owner = new OwnerInfo();
    $user = $owner->show_ownerinfo($_SESSION["user_id"]);
    


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
    <div class = "dashboard-container">
        
        <table>
        <thead>
        <tr>
            <th>Item ID</th>
            <th>Item Type</th>
            <th>Item Brand</th>
            <th>Item Color</th>
            <th>Item Picture</th>
            <th>Report Type</th>

    </tr>
    <tbody>
        <?php if ($rows): ?>
        <?php foreach ($rows as $row): ?>
        
                
                        <tr>
                        <td><?= $row->id ?></td>
                        <td><?= $row->blocknumber ?></td>
                        <td><?= $row->lotnumber ?></td>
                        <td><?= $row->rentprice ?></td>
                        <td><?= $row->downpayment?></td>
                        <td>Missing</td>
                        </tr>
                
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        </table>
        
</body>
</div>
 <footer>
        <p>© 2026 RHS by C.J.C. All rights reserved.</p>
    </footer>
</body>
</html>