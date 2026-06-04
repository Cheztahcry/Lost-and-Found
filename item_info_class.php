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

    }
    $item_type = trim(($_POST['itemtype'] ?? null));
    $item_name = trim(($_POST['itemname'] ?? null));
    $item_img = trim(($_POST['itemimg'] ?? null));
    $date = trim(($_POST['date'] ?? null));
    $insert_info = [ 
                "item_type" => $item_type,
                "item_name" => $item_name,
                "item_img" => $item_img,
                "date" => $date
                  ];
    $create_info = [
       'item_id' => 'INT AUTO_INCREMENT PRIMARY KEY',
       'item_type' => 'varchar(255) NOT NULL',
       'item_name' => 'varchar(255) NOT NULL',
       'item_img' => 'varchar(255) NOT NULL',
       'date' => 'DATE NOT NULL'
    ];
    $errors = [];
    
    // Check for empty fields; If their is empty field add it to the error list
    foreach ($insert_info as $info => $errorMessage) {
    if (empty(trim($_POST[$info] ?? ''))) {
        $errors[$info] = $errorMessage;
        
    }
    }

    if (empty($errors)) {
        $rent = new ItemInfo();
        $rent->item_table($create_info);
        $rent->insert_item_info($insert_info);
        echo "Submit Successful";
        header("Refresh: 5; url=index.php");
        exit;
    }

    





?>