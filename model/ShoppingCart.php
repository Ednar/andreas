<?php

require_once 'PrintProduct.php';
require_once 'helpers/GlobalConstants.php';

/**
 * Class ShoppingCart
 */
class ShoppingCart {

    private $prints = array();

    public function __construct() {
        $this->loadCartFromSession();
    }

    public function __destruct() {
        $this->saveCartToSession();
    }

    public function loadCartFromSession() {
        if (isset($_SESSION[GlobalConstants::CART])) {
            $this->prints = $_SESSION[GlobalConstants::CART];
        }
    }

    public function saveCartToSession() {
        $_SESSION[GlobalConstants::CART] = $this->prints;
    }

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

    public function increaseQuantity($uniqueID) {
        $this->prints[$uniqueID]->incrementQuantity();
    }

    private function putPrintInCart(PrintProduct $print) {
        $this->prints[$print->getUniqueID()] = $print;
    }

    public function getPrints() {
        return $this->prints;
    }

    public function getSum() {
        $sum = 0;
        foreach ($this->prints as $print) {
            $sum += $print->getPrice() * $print->getQuantity();
        }
        return $sum;
    }

    public function decreaseQuantity($uniqueID) {
        if ($this->prints[$uniqueID]->getQuantity() <= 1) {
            $this->remove($uniqueID);
        }  else {
            $this->prints[$uniqueID]->decrementQuantity();
        }
    }

    public function remove($uniqueID) {
        unset($this->prints[$uniqueID]);
    }

    public function isEmpty() {
        return empty($this->prints);
    }
}