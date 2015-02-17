<?php

require_once 'PrintProduct.php';
require_once 'model/ShoppingCart.php';
require_once 'helpers/GlobalConstants.php';

/**
 * Class ShoppingCart
 */
final class ShoppingCart {

    private $prints = array();

    public function __construct() {
        $this->loadCartFromSession();
    }

    public function __destruct() {
        $this->saveCartToSession();
    }

    /**
     * Gets the cart contents from the session
     */
    public function loadCartFromSession() {
        if (isset($_SESSION[GlobalConstants::CART])) {
            $this->prints = $_SESSION[GlobalConstants::CART];
        }
    }

    /**
     * Saves the cart contents to the session
     */
    public function saveCartToSession() {
        $_SESSION[GlobalConstants::CART] = $this->prints;
    }

    /**
     * @param PrintProduct $print print to add to cart
     */
    public function addToCart(PrintProduct $print) {
        if ($this->cartContainsPrint($print)) {
            echo $print->getUniqueID();
            $this->increaseQuantity($print->getUniqueID());
        } else {
            $this->putPrintInCart($print);
        }
    }

    private function cartContainsPrint(PrintProduct $print){
        return isset($this->prints[ $print->getUniqueID() ]);
    }

    /**
     * Increments the print quantity by 1
     *
     * @param $uniqueID int id of print to increment
     */
    public function increaseQuantity($uniqueID) {
        $this->prints[$uniqueID]->incrementQuantity();
    }

    private function putPrintInCart(PrintProduct $print) {
        $this->prints[$print->getUniqueID()] = $print;
    }

    /**
     * @return array shopping cart contents
     */
    public function getPrints() {
        return $this->prints;
    }

    /**
     * @return int the sum all prints in the cart
     */
    public function getSum() {
        $sum = 0;
        foreach ($this->prints as $print) {
            $sum += $print->getPrice() * $print->getQuantity();
        }
        return $sum;
    }

    /**
     * Decrement the print quantity by 1
     *
     * @param $uniqueID string unique id of print to decrement
     */
    public function decreaseQuantity($uniqueID) {
        if ($this->prints[$uniqueID]->getQuantity() <= 1) {
            $this->remove($uniqueID);
        }  else {
            $this->prints[$uniqueID]->decrementQuantity();
        }
    }

    /**
     * @param $uniqueID string unique id of print to remove
     */
    public function remove($uniqueID) {
        unset($this->prints[$uniqueID]);
    }

    /**
     * @return bool
     */
    public function isEmpty() {
        return empty($this->prints);
    }
}