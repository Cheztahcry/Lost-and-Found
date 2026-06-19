<?php

    require_once 'Database.php';
    class ItemInfo extends Database {
        private string $tbl_name = "tbl_iteminfo";
        private $allowedRentColumns = ['item_type', 'item_brand', 'item-color', 'item_date', 'item_image', 'report_type', 'user_id'];
        private $query_config;
        public function __construct() {
        parent::__construct();
        $this->query_config = require __DIR__ . '/query_config.php';
    }
        public function item_table(array $info_list){
            
            $this->create_table($this->tbl_name, $info_list);
        }
        public function insert_item_data(array $item_info){
        $cleanItemData = $this->filterData($item_info, $this->allowedRentColumns);
        try{
            $this->pdo->beginTransaction();
            $this->insert_table($this->query_config['tables']['item'], $cleanItemData);
            $this->pdo->commit();
            header("Location: index.php");
            exit;
        }catch (PDOException $e) {
            $this->pdo->rollBack();
            if ($e->getCode() == 23000 && strpos($e->getMessage(), '1062') !== false) {
                die("House is already registered");
            }
        } 
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
        public function account_transaction(string $report, $userid){
            $query = "SELECT * FROM `{$this->tbl_name}` WHERE user_id = :user AND report_type = :report_type";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['report_type' => $report,
                            'user_id' => $userid]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

    }
    $item_type = trim(($_POST['item_type'] ?? null));
    $item_brand = trim(($_POST['item_brand'] ?? null));
    $item_color = trim(($_POST['item_color'] ?? null));
    $item_image = trim(($_POST['item_image'] ?? null));
    $report_type = trim(($_POST['report_type'] ?? null));
    $item_date = trim(($_POST['item_date'] ?? null));
    $create_info = [
       'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
       'item_type' => 'VARCHAR(200) NOT NULL',
       'item_brand' => 'VARCHAR(200) NOT NULL',
       'item_color' => 'VARCHAR(200) NOT NULL',
       'item_image' => 'VARCHAR(200) NOT NULL',
       'report_type' => 'VARCHAR(500) NOT NULL',
       'item_date' => 'DATE NOT NULL',
       'user_id' => 'INT NOT NULL',
       'FOREIGN KEY'   => '(user_id) REFERENCES tbl_ownerinfo(id) ON DELETE CASCADE'
    ];
    $expected_fields = [
        'item_type'            => 'Block Number is required.',
        'item_brand'            => 'Lot Number is required.',
        'item_color'              => 'Rent Price is required.',
        ];
        
        $errors = [];
        foreach ($expected_fields as $field => $errorMessage) {
        $value = trim($_POST[$field] ?? '');
        
        if ($value === '') {
            $errors[$field] = $errorMessage;
        } else {
            $data_to_submit[$field] = $value;
        }
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($errors)) {
        $insert_info = [ 
                "item_type" => $item_type,
                "item_brand" => $item_brand,
                "item_color" => $item_color,
                'item_image' => $item_image,
                "report_type" => $report_type,
                "user_id" => $_SESSION['user_id'],
                "item_date" => $item_date
            ];
        $item = new ItemInfo();
        $item->item_table($create_info);
        $item->insert_item_data($insert_info);
        }
    }

    
    

    





?>