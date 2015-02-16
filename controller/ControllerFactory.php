<?php

require_once 'IndexController.php';
require_once 'PrintInfoController.php';
require_once 'ProductListController.php';
require_once 'ShoppingCartController.php';
require_once 'admin/AdminAddPrintController.php';
require_once 'admin/AdminProductListController.php';
require_once 'adminAdminstInsertPrint.php';

/**
 * Class ControllerFactory
 *
 */
class ControllerFactory {

    /**
     * Creates a new controller the provided controller name
     *
     * @param $controller string name of the controller to return
     * @return mixed
     * @throws InvalidControllerException if the provided controller name does not exist
     */
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