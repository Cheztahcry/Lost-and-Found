<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/database.php';
$input = trim(($_POST['input'] ?? null));

class SearchResults extends Database{
    private $query_config;  
    private string $tbl_name = "tbl_iteminfo";
    public function __construct() {
    parent::__construct();
    $this->query_config = require __DIR__ . '/query_config.php';
    }
    public function search_query($input){
        $query = "SELECT * FROM `{$this->query_config['tables']['item']}` WHERE id = :input OR item_type LIKE :input OR item_brand LIKE :input";
        $show_query = $this->pdo->prepare($query);
        $show_query->execute(['input' => $input]);
        $results = $show_query->fetchAll(PDO::FETCH_OBJ);
        $row_num = count($results);
        try{
        if ($row_num > 0){?>
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
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php if ($results && count($results) > 0): ?>
                <?php foreach ($results as $row): ?>            
                <tr>
                    <td><?= htmlspecialchars($row->id) ?></td>
                    <td><?= htmlspecialchars($row->item_type) ?></td>
                    <td><?= htmlspecialchars($row->item_brand) ?></td>
                    <td><?= htmlspecialchars($row->item_color) ?></td>
                    <td><?= htmlspecialchars($row->item_image) ?></td>
                    <td><?= htmlspecialchars($row->report_type) ?></td>
                    <td><button type="button" class="action-btn contact-btn">Contact</button>
                    <button type="button" class="action-btn contact-btn">File a missing report</button></td>
    
                    
                </tr>
                    
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


<?php 
        } else {
            // Displays your custom card when a search yields zero matches
            echo "<div class='no-results-card'>";
            echo "<div class='no-results-icon' aria-hidden='true'>🔎</div>";
            echo "<h3>No results found</h3>";
            echo "<p>Try searching by another block number, lot number, or house ID.</p>";
            echo "</div>";
        }
    } catch(PDOException $e) { 
        // Handles SQL Error 1064 safely, or kills the script for other major DB failures
        if (isset($e->errorInfo) && $e->errorInfo[1] == 1064) {
            echo "<div class='no-results-card'>";
            echo "<div class='no-results-icon' aria-hidden='true'>🔎</div>";
            echo "<h3>No results found</h3>";
            echo "<p>Try searching by another block number, lot number, or house ID.</p>";
            echo "</div>";
        } else {
            die("Insert Error: " . $e->getMessage());
        }
    }
}
}



$search = new SearchResults;
$search->search_query($input)

?>
