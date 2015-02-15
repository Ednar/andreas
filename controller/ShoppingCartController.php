<?php

class ShoppingCartController extends BaseController {

    private static $shoppingCart = array();
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

    public function addToCart() {
        $this->updateShoppingCartFromSession();
        $print = $this->getPrintValues();
        if ($this->printAlreadyInCart($print)) {
            $this->incrementPrintAmount($print['uniqueID']);
        } else {
            $this->putPrintInCart($print);
        }
        $this->saveCartToSession();
        $this->showCart();
    }

    private function updateShoppingCartFromSession() {
        if (isset($_SESSION['shopping_cart'])) {
            self::$shoppingCart = $_SESSION['shopping_cart'];
        } else {
            $_SESSION['shopping_cart'] = self::$shoppingCart;
        }
    }

    private function getPrintValues() {
        $print = $this->printDAO->getPrint($_POST['printID']);
        $print['printTypeID'] = $_POST['printTypeID'];
        $print['sizeID'] = $_POST['sizeID'];
        $print['size'] = $this->sizeDAO->getSize($_POST['sizeID']);
        $print['type'] = $this->printTypeDAO->getPrintTypeByID($_POST['printTypeID']);
        $print['price'] = $this->sizeDAO->getPriceForSizeAndType($_POST['printTypeID'], $_POST['sizeID']);
        $print['uniqueID'] = $this->createUniqueIDForPrint($print);
        $print['amount'] = 1;
        return $print;
    }

    private function createUniqueIDForPrint($print) {
        $uniqueID = $print['printID'] . $print['printTypeID'] . $print['sizeID'];
        return trim($uniqueID);
    }

    private function printAlreadyInCart($print) {
        return isset(self::$shoppingCart[$print['uniqueID']]);
    }

    private function incrementPrintAmount($uniqueID) {
        return self::$shoppingCart[$uniqueID]['amount']++;
    }

    private function putPrintInCart($print) {
        return self::$shoppingCart[$print['uniqueID']] = $print;
    }

    public function showCart() {
        $this->updateShoppingCartFromSession();
        if ($this->shoppingCartIsEmpty()) {
            $template = $this->templateEngine->loadTemplate('empty_cart.twig');
        } else {
            $template = $this->templateEngine->loadTemplate('shopping_cart.twig');
        }
        $template->display(array(
            'cart' => self::$shoppingCart,
            'sum' => $this->getShoppingCartSum()
        ));
    }

    private function saveCartToSession() {
        $_SESSION['shopping_cart'] = self::$shoppingCart;
    }

    private function getShoppingCartSum() {
        $sum = 0;
        foreach (self::$shoppingCart as $row) {
            $sum += $row['price'][0] * $row['amount'];
        }
        return $sum;
    }

    private function shoppingCartIsEmpty() {
        return empty(self::$shoppingCart);
    }

    public function decreaseAmount($uniqueID) {
        $this->updateShoppingCartFromSession();
        if ($this->shoppingCartContainsPrint($uniqueID)) {
            $this->decrementPrintAmmount($uniqueID);
            if (self::$shoppingCart[$uniqueID]['amount'] <= 0) {
                $this->removePrintFromCart($uniqueID);
            }
        }
        $this->saveCartToSession();
        $this->showCart();
    }

    private function shoppingCartContainsPrint($uniqueID) {
        return isset(self::$shoppingCart[$uniqueID]);
    }

    private function decrementPrintAmmount($uniqueID) {
        self::$shoppingCart[$uniqueID]['amount']--;
    }

    private function removePrintFromCart($uniqueID) {
        unset(self::$shoppingCart[$uniqueID]);
    }

    public function increaseAmount($uniqueID) {
        $this->updateShoppingCartFromSession();
        if ($this->shoppingCartContainsPrint($uniqueID)) {
            $this->incrementPrintAmount($uniqueID);
        }
        $this->saveCartToSession();
        $this->showCart();
    }
}