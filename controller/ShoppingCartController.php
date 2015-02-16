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
        $this->printDAO = new PrintDAO();
        $this->sizeDAO = new SizeDAO();
        $this->printTypeDAO = new PrintTypeDAO();
        self::$shoppingCart = new ShoppingCart();

        if (isset($_SESSION['shopping_cart'])) {
            $this->prints = $_SESSION['shopping_cart'];
        } else {
            $_SESSION['shopping_cart'] = $this->prints;
        }
    }

    public function __destruct() {
        self::$shoppingCart->saveCartToSession();
        $this->showCart();
    }

    public function addToCart() {
        $print = $this->getPrint();
        self::$shoppingCart->addToCart($print);
    }

    private function getPrint() {
        $printInfo = $this->printDAO->getPrint($_POST['printID']);
        $print = new PrintProduct($printInfo);
        $print->setSizeID($_POST['sizeID']);
        $print->setTypeID($_POST['typeID']);
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
        if (is_null(self::$shoppingCart)) {
            $template = $this->templateEngine->loadTemplate(self::EMPTY_CART_VIEW);
        }
        return $template;
    }

    public function increaseQuantity($uniqueID) {
        self::$shoppingCart->increaseQuantity($uniqueID);
    }

    public function decreaseQuantity($uniqueID) {
        self::$shoppingCart->decreaseQuantity($uniqueID);
    }

    public function remove($uniqueID) {
        self::$shoppingCart->remove($uniqueID);
    }
}