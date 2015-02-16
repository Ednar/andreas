<?php

require_once 'controller/BaseController.php';

class AdminInsertPrint extends BaseController {
    
    private $printDAO;

    public function __construct() {
        parent::__construct();
        $databaseHandle = new DatabaseHandle();
        $this->printDAO = new PrintDAO($databaseHandle);
    }
    
    public function insertPrint($image, $title, $alt, $category) {
        
    }
    
}
