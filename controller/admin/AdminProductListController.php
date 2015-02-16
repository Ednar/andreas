<?php

require_once 'controller/BaseController.php';

class AdminProductListController extends BaseController {

    private $printDAO;

    public function __construct() {
        parent::__construct();
        $databaseHandle = new DatabaseHandle();
        $this->printDAO = new PrintDAO($databaseHandle);
    }

    public function getAllPrints() {
        $pictures = $this->printDAO->getAllPrints();
        $template = $this->templateEngine->loadTemplate('test.twig');
        $template->display(array(
            'pictures' => $pictures,
            'qty' => empty($_SESSION) ? "" : count($_SESSION['shopping_cart']),
        ));
    }
}