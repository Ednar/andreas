<?php

require_once 'controller/BaseController.php';
require_once 'model/dao/CategoriesDAO.php';
require_once 'helpers/GlobalConstants.php';
require_once 'model/dao/ImageDAO.php';
require_once 'model/dao/SizeDAO.php';

class AdminAddPrintController extends BaseController {

    private $categoriesDAO;
    private $printDAO;
    private $imageDAO;
    private $sizeDAO;

    private $target = 'img/printImg/';

    public function __construct() {
        parent::__construct();
        $this->categoriesDAO = new CategoriesDAO();
        $this->printDAO = new PrintDAO();
        $this->imageDAO = new ImageDAO();
        $this->sizeDAO = new SizeDAO();
    }

    public function addPrint() {
        $categories = $this->categoriesDAO->getAllCategories();
        $template = $this->templateEngine->loadTemplate('admin/admin_add_print.twig');
        $template->display(array(
            'categories' => $categories
        ));
    }

    public function savePrint() {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageAlt = $_POST['alt'];
        move_uploaded_file($imageTmpName, $this->target . $imageName);
        $this->imageDAO->insertImage($imageName, $imageAlt);

        $imageID = $this->imageDAO->getImageID($imageName);
        $title = $_POST[GlobalConstants::PRINT_TITLE];
        $description = $_POST[GlobalConstants::PRINT_DESCRIPTION];
        $categoryID = $_POST[GlobalConstants::CATEGORY_ID];
        $this->printDAO->insertPrint($title, $description, $imageID, $categoryID);


        $sizeIDs = $this->getSizeIDs();
        $printID = $this->printDAO->getPrintIDByTitle($title);
        $this->sizeDAO->setSizeToPrint($printID, $sizeIDs);

        $prints = $this->printDAO->getAllPrints();
        $template = $this->templateEngine->loadTemplate('admin/admin_print_list.twig');
        $template->display(array(
            'status' => 'Print successfully added',
            'prints' => $prints,
        ));
    }


    private function aspectRatioIsWide($imageWidth, $imageHeight){
        return $imageWidth / $imageHeight > 2 ? true : false;
    }

    private function getSizeIDs() {
        $imageName = $_FILES['image']['name'];
        $imageWidth = getImageSize($this->target . $imageName)[0];
        $imageHeight = getImageSize($this->target . $imageName)[1];
        if ( $this->aspectRatioIsWide($imageWidth, $imageHeight)) {
            return $this->sizeDAO->getSizeIDsForAspectRatioWide();
        } else {
            return $this->sizeDAO->getSizeIDsForAspectRatioFat();
        }
    }
}