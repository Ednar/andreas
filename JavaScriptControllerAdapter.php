<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'controller/ProductListController.php';
require_once 'controller/ControllerFactory.php';

$queries = explode('/', $_SERVER['PATH_INFO']);

$controller = ControllerFactory::create($queries[1]);
$function = $queries[2];

echo json_encode($controller->$function());

