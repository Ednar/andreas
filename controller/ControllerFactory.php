<?php

require_once 'IndexController.php';
require_once 'PrintInfoController.php';
require_once 'ProductListController.php';
require_once 'ShoppingCartController.php';

class ControllerFactory {

    public static function create($controller) {
        $controllerType = $controller . 'Controller';
        if (class_exists($controllerType)) {
            return new $controllerType();
        } else {
            throw new InvalidControllerException("No matching controller found");
        }
    }
}

class InvalidControllerException extends Exception {

    public function __construct($message = null) {
        parent::$message = $message;
    }
}