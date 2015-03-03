<?php

final class AdminProductListController  {

    private $printDAO;

    public function __construct() {
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