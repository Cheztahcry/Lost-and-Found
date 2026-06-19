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
        <table>
            <thead>
            <tr>
                <th>Item ID</th>
                <th>Item Type</th>
                <th>Item Brand</th> 
                <th>Report Type</th>
            </thead>

            </tr>
            <tbody>
            <?php foreach ($results as $search_row): ?>
                
                        
                                <tr>
                                <td><?= $search_row->id ?></td>
                                <td><?= $search_row->item_type?></td>
                                <td><?= $search_row->item_brand ?></td>
                                <td><?= $search_row->report_type ?></td>

                                <td><button> Inquire </button>
                                <button> Contact </button>
                                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


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
