<?php

require_once 'IndexController.php';
require_once 'PrintInfoController.php';
require_once 'ProductListController.php';
require_once 'ShoppingCartController.php';

class ControllerFactory {

    public function createPrintInfoController() {
        return new PrintInfoController();
    }

    public function createShoppingCartController() {
        return new ShoppingCartController();
    }

    public function createIndexController() {
        return new IndexController();
    }

    public function createProductListController() {
        return new ProductListController();
    }
}