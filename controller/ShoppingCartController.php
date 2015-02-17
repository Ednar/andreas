<?php

require_once 'model/ShoppingCart.php';
require_once 'helpers/GlobalConstants.php';

/**
 * Class ShoppingCartController
 */
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

        if (isset($_SESSION[GlobalConstants::CART])) {
            self::$shoppingCart->loadCartFromSession();
        } else {
            self::$shoppingCart->saveCartToSession();
        }
    }

    /**
     * Saves the cart contents and displays either the standard shopping cart or
     * a page for the empty cart
     */
    public function __destruct() {
        self::$shoppingCart->saveCartToSession();
        $template = $this->templateEngine->loadTemplate(self::SHOPPING_CART_VIEW);
        if ($this->cartIsEmpty()) {
            $template = $this->templateEngine->loadTemplate(self::EMPTY_CART_VIEW);
        }
        $template->display(array(
                'cart' => self::$shoppingCart)
        );
    }

    private function cartIsEmpty() {
        return self::$shoppingCart->isEmpty();
    }

    /**
     * Add a print to the cart
     */
    public function addToCart() {
        $print = $this->getPrint();
        self::$shoppingCart->addToCart($print);
    }

    private function getPrint() {
        $printInfo = $this->printDAO->getPrintByID($_POST[GlobalConstants::PRINT_ID]);
        $print = new PrintProduct($printInfo);
        $print->setSizeID($_POST[GlobalConstants::SIZE_ID]);
        $print->setTypeID($_POST[GlobalConstants::TYPE_ID]);
        $print->setSize($this->sizeDAO->getSize($_POST[GlobalConstants::SIZE_ID]));
        $print->setType($this->printTypeDAO->getPrintTypeByID($_POST[GlobalConstants::TYPE_ID]));
        $print->setPrice($this->sizeDAO->getPriceForSizeAndType(
            $_POST[GlobalConstants::TYPE_ID],
            $_POST['sizeID']));
        return $print;
    }

    /**
     * Displays the shopping cart contents
     */
    public function showCart() { } // Cart renders on destruct

    /**
     * Increases the quantity of the print by 1
     *
     * @param $uniqueID the unique ID of the print to increment
     */
    public function increaseQuantity($uniqueID) {
        self::$shoppingCart->increaseQuantity($uniqueID);
    }

    /**
     * Decreases the quantity of the print by 1
     *
     * @param $uniqueID the unique ID of the print to decrement
     */
    public function decreaseQuantity($uniqueID) {
        self::$shoppingCart->decreaseQuantity($uniqueID);
    }

    /**
     * Removes a print from the cart
     *
     * @param $uniqueID the unique ID of the print to decrement
     */
    public function remove($uniqueID) {
        self::$shoppingCart->remove($uniqueID);
    }
}