<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'ProductListController.php';
require_once 'ControllerFactory.php';

$queries = explode('/', $_SERVER['PATH_INFO']);

$controller = ControllerFactory::create($queries[1]);
$function = $queries[2];

if (isset($queries[3])) {
    echo json_encode($controller->$function($queries[3]));
} else {
    echo json_encode($controller->$function());
}