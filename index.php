<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'controller/Controller.php';

$queries = explode('/', $_SERVER['QUERY_STRING']);

$controller = new Controller();
$controller->$queries[0]();
