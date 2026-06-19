<?php

    require_once 'Database.php';
    class ItemInfo extends Database {
        private string $tbl_name = "tbl_iteminfo";
        public function __construct() {
        parent::__construct();
    }
        public function item_table(array $info_list){
            
            $this->create_table($this->tbl_name, $info_list);
        }
        public function insert_item_info(array $info_list){
            
            $this->insert_table($this->tbl_name, $info_list);
        }
        public function show_item_info(){
            return $this->show_table($this->tbl_name);
        }
        public function specific_type(string $report){
            $query = "SELECT * FROM `{$this->tbl_name}` WHERE report_type = :report_type";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['report_type' => $report]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

    }
    $item_type = trim(($_POST['item_type'] ?? null));
    $item_brand = trim(($_POST['item_brand'] ?? null));
    $item_color = trim(($_POST['item_color'] ?? null));
    $item_image = trim(($_POST['item_image'] ?? null));
    $report_type = trim(($_POST['report_type'] ?? null));
    $insert_info = [ 
                "item_type" => $item_type,
                "item_brand" => $item_brand,
                "item_color" => $item_color,
                "report_type" => $report_type
                  ];
    $create_info = [
       'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
       'item_type' => 'VARCHAR(200) NOT NULL',
       'item_brand' => 'VARCHAR(200) NOT NULL',
       'item_color' => 'VARCHAR(200) NOT NULL',
       'item_image' => 'VARCHAR(200) NOT NULL',
       'report_type' => 'VARCHAR(500) NOT NULL'
    ];
    $errors = [];

    foreach ($insert_info as $info => $errorMessage) {
    $value = trim($_POST[$info] ?? '');
    if ($value === '') {
        $errors[$info] = $errorMessage;
        return($_POST[$info] ?? "$info is missing/empty<br>");
        print_r($insert_info);
    }
}

    if (empty($errors)) {
        $rent = new ItemInfo();
        $rent->item_table($create_info);
        $rent->insert_item_info($insert_info);
        echo "Submit Successful...";
        header("Refresh: 5; url=index.php");
        exit;
    }
    

    





?>