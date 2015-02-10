<?php

require_once 'IFrontController.php';
require_once 'ControllerFactory.php';
session_start();

class FrontController implements IFrontController {

    const DEFAULT_CONTROLLER = 'IndexController';

    private $controllerFactory;

    protected $controller = self::DEFAULT_CONTROLLER;
    protected $loader;
    protected $twig;

    public function __construct($queries) {
        $this->controllerFactory = new ControllerFactory();

        $action = 'create' . $queries[0];
        $this->controller = $this->controllerFactory->$action();
        if (isset($queries[2])) {
            $this->controller->$queries[1]($queries[2]);
        } else {
            $this->controller->$queries[1]();
        }
    }
}
