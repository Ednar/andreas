<?php

require_once 'IFrontController.php';
require_once 'ControllerFactory.php';
session_start();

class FrontController implements IFrontController {

    const DEFAULT_CONTROLLER = 'IndexController';

    protected $controller = self::DEFAULT_CONTROLLER;
    protected $loader;
    protected $twig;

    public function __construct($queries) {
        $this->controllerFactory = new ControllerFactory();

        $action = $queries[0];
        $this->controller = ControllerFactory::create($action);
        if (isset($queries[2])) {
            $this->controller->$queries[1]($queries[2]);
        } else {
            $this->controller->$queries[1]();
        }
    }
}
