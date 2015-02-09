<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'controller/Controller.php';



$queries = explode('/', $_SERVER['QUERY_STRING']);

$controller = new Controller();

if(!method_exists($controller, $queries[0])) {
    $controller->showStart();
} else if (isset($queries[1])) {
    $controller->$queries[0]($queries[1]);
} else {
    $controller->$queries[0]();
}

