<?php

require_once 'ControllerFactory.php';
session_start();

/**
 * Class Router
 *
 * Parses the request from the URI and calls the appropriate controller with
 * the requested arguments and parameters.
 *
 * Should the request be incomplete or incorrect the router will provide a
 * default route.
 */
final class Router {

    const DEFAULT_CONTROLLER = 'Index';
    const DEFAULT_ACTION = 'showStart';

    /**
     * @var array
     */
    private $queries;

    /**
     * Parses the URI and delegates to a controller
     */
    public function __construct() {
        $this->queries = $this->getQueriesFromURL();
        $this->run(
            $this->getController(),
            $this->getAction(),
            $this->getParams()
        );
    }

    private function getQueriesFromURL() {
        return explode('/', $_SERVER['QUERY_STRING']);
    }

    private function run($controller, $action, $parameter) {
        if (is_null($parameter)) {
            $controller->$action();
        } else {
            $controller->$action($parameter);
        }
    }

    private function getController() {
        if ($this->validControllerExists()) {
            return ControllerFactory::create($this->queries[0]);
        } else {
            return ControllerFactory::create(self::DEFAULT_CONTROLLER);
        }
    }

    private function validControllerExists() {
        return class_exists($this->queries[0] . 'Controller');
    }

    private function getAction() {
        if (isset($this->queries[1])) {
            return $this->queries[1];
        }
        return self::DEFAULT_ACTION;
    }

    private function getParams() {
        if (isset($this->queries[2])) {
            return $this->queries[2];
        }
        return null;
    }
}
