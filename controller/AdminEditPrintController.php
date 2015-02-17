<?php

require_once 'controller/BaseController.php';

class AdminEditPrintController extends BaseController{

    private $printDAO;
    private $categoriesDAO;

    public function __construct() {
        parent::__construct();
        $this->printDAO = new PrintDAO();
        $this->categoriesDAO = new CategoriesDAO();
    }

    public function editPrint($printID) {
        $print = $this->printDAO->getPrintByID($printID);
        $categories = $this->categoriesDAO->getAllCategories();
        $template = $this->templateEngine->loadTemplate('admin/admin_edit_print.twig');
        $template->display(array('print' => $print, 'categories' => $categories
        ));
    }

    public function updatePrint($printID) {
        $this->$printID = $printID;
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $this->printDAO->updateSelectedPrint($printID, $title, $description, $category);

        $prints = $this->printDAO->getAllPrints();
        $template = $this->templateEngine->loadTemplate('admin/admin_print_list.twig');
        $template->display(array(
            'status' => 'Update successful',
            'prints' => $prints
        ));


    }

}