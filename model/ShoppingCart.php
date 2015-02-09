<?php

class ShoppingCart {

    private $products;

    public function __construct() {
        $this->products = Array();
    }

    public function addProduct($product) {
        $this->products[] = $product;
    }

    public function deleteProduct($product) {
        unset($this->products[$product]);
    }
}