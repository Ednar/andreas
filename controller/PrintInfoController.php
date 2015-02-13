<?php

require_once 'BaseController.php';
require_once 'model/PrintDAO.php';
require_once 'model/SizeDAO.php';
require_once 'model/PrintTypeDAO.php';

class PrintInfoController extends BaseController {

    private $printDAO;
    private $sizeDAO;
    private $printTypeDAO;

    protected final function initialize() {
        $databaseManager = new MySQLConnectionManager();
        $this->printDAO = new PrintDAO($databaseManager);
        $this->sizeDAO = new SizeDAO($databaseManager);
        $this->printTypeDAO = new PrintTypeDAO($databaseManager);
    }

    public function getPrintInfo($printID) {
        $printInfo = $this->printDAO->getPrint($printID);
        $sizes = $this->sizeDAO->getSizesForPrint($printID);
        $printTypes = $this->printTypeDAO->getAllPrintTypes();
        $template = $this->templateEngine->loadTemplate('print_info.twig');
        $template->display(array(
            'print' => $printInfo,
            'sizes' => $sizes,
            'types' => $printTypes
        ));
    }


}