<?php

require_once 'controller/BaseController.php';

class AdminProductListController extends BaseController {

    private $printDAO;

    public function __construct() {
        parent::__construct();
        $this->printDAO = new PrintDAO();
    }

    public function getAllPrints() {
        $prints = $this->printDAO->getAllPrints();
        $template = $this->templateEngine->loadTemplate('admin/admin_print_list.twig');
        $template->display(array(
            'prints' => $prints,
        ));
    }
}