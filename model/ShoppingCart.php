<?php

require_once 'PrintProduct.php';

class ShoppingCart {

    private $prints = array();

    public function __construct() {
        $this->loadCartFromSession();
    }

    public function __destruct() {
        $this->saveCartToSession();
    }

    public function loadCartFromSession() {
        if (isset($_SESSION['shopping_cart'])) {
            $this->prints = $_SESSION['shopping_cart'];
        }
    }

    public function saveCartToSession() {
        $_SESSION['shopping_cart'] = $this->prints;
    }

    public function addToCart(PrintProduct $print) {
        if ($this->cartContainsPrint($print)) {
            $this->increaseQuantity($print->getUniqueID());
        } else {
            $this->putPrintInCart($print);
        }
    }

    private function cartContainsPrint(PrintProduct $print){
        return isset($this->prints[$print->getUniqueID()]);
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
}