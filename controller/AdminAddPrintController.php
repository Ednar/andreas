<?php

require_once 'controller/BaseController.php';
require_once 'model/dao/CategoriesDAO.php';
require_once 'helpers/GlobalConstants.php';

class AdminAddPrintController extends BaseController {

    private $categoriesDAO;
    private $printDAO;

    public function __construct() {
        parent::__construct();
        $this->categoriesDAO = new CategoriesDAO();
        $this->printDAO = new PrintDAO();
    }

    public function addPrint() {
        $categories = $this->categoriesDAO->getAllCategories();
        $template = $this->templateEngine->loadTemplate('admin/admin_add_print.twig');
        $template->display(array(
            'categories' => $categories
        ));
    }

    public function selectImage() {

    }

    public function savePrint() {
        $name = $_POST[GlobalConstants::PRINT_TITLE];
        $description = $_POST[GlobalConstants::PRINT_DESCRIPTION];
        $categoryID = $_POST[GlobalConstants::CATEGORY_ID];
        $imageID = 0;

     //  $this->printDAO->insertPrint($name, $description, $categoryID, $imageID);
    }
}