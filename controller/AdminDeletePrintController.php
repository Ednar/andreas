<?php
require_once 'controller/BaseController.php';

class AdminDeletePrintController extends BaseController {

private $printDAO;

public function __construct() {
    parent::__construct();
    $this->printDAO = new PrintDAO();
}

public function deletePrint($printID){
    $template = $this->templateEngine->loadTemplate('admin/admin_delete_print.twig');
    $template->display(array('printID' => $printID
    ));
}

    public function confirmedDeletePrint($printID){
       $this->printDAO->deleteImageFromFilesystem($printID);
        $this->printDAO->deletePrint($printID);

        $prints = $this->printDAO->getAllPrints();
        $template = $this->templateEngine->loadTemplate('admin/admin_print_list.twig');
        $template->display(array(
            'status' => 'Delete successful',
            'prints' => $prints
        ));


    }

    public function getAllPrints(){
        return $this->printDAO->getAllPrints();

    }


}



