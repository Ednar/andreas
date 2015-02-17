<?php

/**
 * Class ProductListController
 */
class ProductListController extends BaseController {

    private $printDAO;

    public function __construct() {
        parent::__construct();
        $this->printDAO = new PrintDAO();
    }

    /**
     * Renders a list of all stored prints
     */
    public function getAllPrints() {
        $pictures = $this->printDAO->getAllPrints();
        $template = $this->templateEngine->loadTemplate('test.twig');
        $template->display(array(
            'pictures' => $pictures
        ));
    }
}