<?php

require_once 'model/ShoppingCart.php';

class ShoppingCartController extends BaseController {

    const SHOPPING_CART_VIEW = 'shopping_cart.twig';
    const EMPTY_CART_VIEW = 'empty_cart.twig';

    private static $shoppingCart;
    private $printDAO;
    private $sizeDAO;
    private $printTypeDAO;

    public function __construct() {
        parent::__construct();
        $databaseHandle = new DatabaseHandle();
        $this->printDAO = new PrintDAO($databaseHandle);
        $this->sizeDAO = new SizeDAO($databaseHandle);
        $this->printTypeDAO = new PrintTypeDAO($databaseHandle);
        self::$shoppingCart = new ShoppingCart();
    }


    public function addToCart() {
        $print = $this->getPrint();
        self::$shoppingCart->add($print);
        $this->showCart();
    }

    private function getPrint() {
        $printInfo = $this->printDAO->getPrint($_POST['printID']);
        $image = new PrintImage($printInfo['fullSize'], $printInfo['thumbnail'], $printInfo['alt']);
        $print = new PrintProduct($printInfo, $image);
        $print->setTypeID($_POST['printTypeID']);
        $print->setSizeID($_POST['sizeID']);
        $print->setSize($this->sizeDAO->getSize($_POST['sizeID']));
        $print->setType($this->printTypeDAO->getPrintTypeByID($_POST['printTypeID']));
        $print->setPrice($this->sizeDAO->getPriceForSizeAndType($_POST['printTypeID'], $_POST['sizeID']));
        return $print;
    }


    public function showCart() {
        $template = $this->loadTemplate();
        $template->display(array(
            'cart' => self::$shoppingCart,
        ));
    }

    private function loadTemplate() {
        $template = $this->templateEngine->loadTemplate(self::SHOPPING_CART_VIEW);
        if (!isset(self::$shoppingCart)) {
            $template = $this->templateEngine->loadTemplate(self::EMPTY_CART_VIEW);
        }
        return $template;
    }


    public function decreaseQuantity($uniqueID) {
        self::$shoppingCart->decreaseQuantity($uniqueID);
        $this->showCart();
    }


    public function increaseQuantity($uniqueID) {
        self::$shoppingCart->increaseQuantity($uniqueID);
        $this->showCart();
    }

    public function remove($uniqueID) {
        self::$shoppingCart->remove($uniqueID);
        $this->showCart();
    }
}