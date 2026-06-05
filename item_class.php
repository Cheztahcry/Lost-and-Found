<?php

    require_once 'Database.php';
    class ItemInfo extends Database {
        private string $tbl_name = "tbl_rentinfo";
        public function __construct() {
        parent::__construct();
    }
        public function item_table(array $info_list){
            
            $this->create_table($this->tbl_name, $info_list);
        }
        public function insert_rent_info(array $info_list){
            
            $this->insert_table($this->tbl_name, $info_list);
        }
        public function show_item_info(){
            return $this->show_table($this->tbl_name);
        }

    }
    $item_type = trim(($_POST['item_type'] ?? null));
    $item_brand = trim(($_POST['item_brand'] ?? null));
    $item_color = trim(($_POST['item_color'] ?? null));
    $item_image = trim(($_POST['item_image'] ?? null));
    $insert_info = [ 
                "item_type" => $item_type,
                "item_brand" => $item_brand,
                "item_color" => $item_color,
                "item_image" => $item_image 
                  ];
    $create_info = [
       'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
       'item_type' => 'VARCHAR(200) NOT NULL',
       'item_brand' => 'VARCHAR(200) NOT NULL',
       'item_color' => 'VARCHAR(200) NOT NULL',
       'item_image' => 'VARCHAR(200) NOT NULL'
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