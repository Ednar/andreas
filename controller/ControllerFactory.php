<?php

require_once 'IndexController.php';
require_once 'PrintInfoController.php';
require_once 'ProductListController.php';
require_once 'ShoppingCartController.php';
require_once 'AdminProductListController.php';

class ControllerFactory {

    public static function create($controller) {
        $controllerType = $controller . 'Controller';
        if (class_exists($controllerType)) {
            return new $controllerType();
        } else {
            throw new Exception("Invalid controller name");
        }
    }
}