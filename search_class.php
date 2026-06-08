<?php
include_once __DIR__ . '/database.php';
$input = trim(($_POST['input'] ?? null));

class SearchResults extends Database{
    private string $tbl_name = "tbl_iteminfo";
    public function __construct() {
    parent::__construct();
    }
    public function search_query($input){
        $query = "SELECT * FROM `{$this->tbl_name}` WHERE id = '$input' OR item_type LIKE '$input%' OR item_brand LIKE '$input%'";
        $show_query = $this->pdo->query($query);
        $results = $show_query->fetchAll(PDO::FETCH_OBJ);
        $row_num = count($results);
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
        }else{
        echo "<h6 class = 'text-danger text-center mt-3'> No Data Found</h6>";
    }
    }
}



$search = new SearchResults;
$search->search_query($input)

?>
