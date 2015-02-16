<?php

require_once 'BaseController.php';
require_once 'model/dao/PrintDAO.php';
require_once 'model/dao/SizeDAO.php';
require_once 'model/dao/PrintTypeDAO.php';
require_once 'model/PrintImage.php';
require_once 'model/PrintProduct.php';

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

    /**
     * Gets and displays the information page for a specific print based on
     * the unique identifier
     *
     * @param $printID unique print identifier
     */
    public function getPrintInfo($printID) {
        $printInfo = $this->printDAO->getPrint($printID);
        $image = new PrintImage($printInfo['fullSize'], $printInfo['thumbnail'], $printInfo['alt']);
        $print = new PrintProduct($printInfo, $image);
        $print->setSizeOptions($this->sizeDAO->getSizesForPrint($printID));
        $print->setTypeOptions( $this->printTypeDAO->getAllPrintTypes());
        $template = $this->templateEngine->loadTemplate('print_info.twig');
        $template->display(array(
            'print' => $print
        ));
    }


}