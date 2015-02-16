<?php

require_once 'PrintProduct.php';

class ShoppingCart {

    private $prints = array();

    public function __construct() {
        $this->prints = array();
        if (isset($_SESSION['shopping_cart'])) {
            $this->prints = $_SESSION['shopping_cart'];
        } else {
            $_SESSION['shopping_cart'] = $this->prints;
        }
    }

    public function add(PrintProduct $print) {
        if (isset($this->prints[$print->getUniqueID()])) {
            $this->prints[$print->getUniqueID()]->incrementQuantity();
        } else {
            $this->prints[$print->getUniqueID()] = $print;
        }
        $_SESSION['shopping_cart'] = $this->prints;
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
        $this->prints = array();
        if (isset($_SESSION['shopping_cart'])) {
            $this->prints = $_SESSION['shopping_cart'];
        } else {
            $_SESSION['shopping_cart'] = $this->prints;
        }
        if ($this->prints[$uniqueID]->getQuantity() <= 1) {
            $this->remove($uniqueID);
        }  else {
            $this->prints[$uniqueID]->decrementQuantity();
        }
        $_SESSION['shopping_cart'] = $this->prints;
    }

    public function increaseQuantity($uniqueID) {
        if (isset($this->prints[$uniqueID])) {
            $this->prints[$uniqueID]->incrementQuantity();
        }
    }

    public function remove($uniqeID) {
        unset($this->prints[$uniqeID]);
    }
}