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

        if (empty($queries[0])) {
            $queries[0] = 'IndexController';
        }

        $action = 'create' . $queries[0];
        $this->controller = $this->controllerFactory->$action();

        if (!isset($queries[1])) {
            $this->controller->showStart();
        } else if (!isset($queries[2])) {
            $this->controller->$queries[1]();
        } else {
            $this->controller->$queries[1]($queries[2]);
        }
    }

}
