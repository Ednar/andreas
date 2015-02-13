<?php

class ProductListController extends BaseController {

    private $printDAO;

    protected final function initialize()
    {
        $databaseManager = new MySQLConnectionManager();
        $this->printDAO = new PrintDAO($databaseManager);
    }

    public function getAllPrints() {
        $pictures = $this->printDAO->getAllPrints();
        $template = $this->templateEngine->loadTemplate('test.twig');
        $template->display(array(
            'pictures' => $pictures
        ));
    }
}