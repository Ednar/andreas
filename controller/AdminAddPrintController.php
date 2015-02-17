<?php

require_once 'BaseController.php';
require_once 'model/dao/CategoriesDAO.php';
require_once 'helpers/GlobalConstants.php';
require_once 'model/dao/ImageDAO.php';
require_once 'model/dao/SizeDAO.php';

/**
 * Class AdminAddPrintController
 */
final class AdminAddPrintController extends BaseController {

    private $categoriesDAO;
    private $printDAO;
    private $imageDAO;
    private $sizeDAO;

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
        $target = 'img/printImg/';
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        move_uploaded_file($imageTmpName, $target . $imageName);
        $imageAlt = $_POST['alt'];
        $this->imageDAO->insertImage($imageName, $imageAlt);

        $imageID = $this->imageDAO->getImageID($imageName);
        $title = $_POST[GlobalConstants::PRINT_TITLE];
        $description = $_POST[GlobalConstants::PRINT_DESCRIPTION];
        $categoryID = $_POST[GlobalConstants::CATEGORY_ID];
        $this->printDAO->insertPrint($title, $description, $imageID, $categoryID);

        $imageWidth = getImageSize($target . $imageName)[0];
        $imageHeight = getImageSize($target . $imageName)[1];

        $wideScreen = $imageWidth / $imageHeight  > 2 ? true : false;
        $sizeIDs = null;
        if ($wideScreen) {
            $sizeIDs = $this->sizeDAO->getSizeIDsForAspectRatioWide();
        } else {
            $sizeIDs = $this->sizeDAO->getSizeIDsForAspectRatioFat();
        }
        $printID = $this->printDAO->getPrintIDByTitle($title);

        $this->sizeDAO->setSizeToPrint($printID, $sizeIDs);

        $prints = $this->printDAO->getAllPrints();
        $template = $this->templateEngine->loadTemplate('admin/admin_print_list.twig');
        $template->display(array(
            'status' => 'Print successfully added',
            'prints' => $prints,
        ));
    }
}