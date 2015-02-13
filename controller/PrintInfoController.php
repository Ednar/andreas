<?php

require_once 'BaseController.php';
require_once 'model/PrintDAO.php';
require_once 'model/SizeDAO.php';
require_once 'model/PrintTypeDAO.php';

class PrintInfoController extends BaseController {

    private $printDAO;
    private $sizeDAO;
    private $printTypeDAO;

    public function __construct() {
        parent::__construct();
        $databaseHandle = new DatabaseHandle();
        $this->printDAO = new PrintDAO($databaseHandle);
        $this->sizeDAO = new SizeDAO($databaseHandle);
        $this->printTypeDAO = new PrintTypeDAO($databaseHandle);
    }

    public function getPrintInfo($printID) {
        $printInfo = $this->printDAO->getPrint($printID);
        $sizes = $this->sizeDAO->getSizesForPrint($printID);
        $printTypes = $this->printTypeDAO->getAllPrintTypes();
        $template = $this->templateEngine->loadTemplate('print_info.twig');
        $template->display(array(
            'print' => $printInfo,
            'sizes' => $sizes,
            'types' => $printTypes,
            'qty' => $_SESSION['qty'],
        ));
    }


}