<?php

require_once '../model/dao/CategoriesDAO.php';
require_once '../helpers/GlobalConstants.php';
require_once '../model/dao/ImageDAO.php';
require_once '../model/dao/SizeDAO.php';

/**
 * Class AdminAddPrintController
 */
final class AdminAddPrintController {

    private $categoriesDAO;
    private $printDAO;
    private $imageDAO;
    private $sizeDAO;

    public function __construct() {
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
        
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES['image']['tmp_name']);
        $extension = end($temp);
        //Kontrollerar att uppladdad fil faksitk är en bild, inte är för stor och har rätt sorts filändelse
        if ((($_FILES["image"]["type"] == "image/gif")
        || ($_FILES["image"]["type"] == "image/jpeg")
        || ($_FILES["image"]["type"] == "image/jpg")
        || ($_FILES["image"]["type"] == "image/pjpeg")
        || ($_FILES["image"]["type"] == "image/png")
        || exif_imagetype($_FILES["image"]["type"] == IMAGETYPE_PNG)
        || ($_FILES["image"]["type"] == "image/x-png")
        && ($_FILES["image"]["size"] < 5000000)
        && in_array($extension, $allowedExts))) { 
        
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
        } else {
            $template = $this->templateEngine->loadTemplate('admin/admin_add_print.twig');
            $template->display(array(
            'status' => 'Felaktig filtyp. Tillåtna filtyper är: gif, jpeg, jpg, pjpeg, png och x-png',
        ));
        }
    }
}