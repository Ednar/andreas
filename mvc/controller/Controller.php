<?php

/**
 * Description of Controller
 *
 * @author noworries
 */

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

include_once 'mvc/model/Model.php';

class Controller {
    public $model;
    
    public function __construct() {
        $this->model = new Model();
    }
    
    public function invoke() {
        if(!isset($_GET['print'])) {
            //Om inget särskilt tryck är valt, visa lista över alla
            $prints = $this->model->getAllPrints();
            include 'mvc/view/printlist.php';
        }
        else {
            //Annars visa valt tryck
            $print = $this->model->getPrintByTitle($_GET['print']);
            include 'mvc/view/viewprint.php';
        }
    }
}

?>