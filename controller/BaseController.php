<?php

require_once 'twig/lib/Twig/Autoloader.php';
require_once 'model/PrintDAO.php';

abstract class BaseController {

    protected $model;
    protected $loader;
    protected $templateEngine;

    public function __construct() {
        $this->model = $this->model = new PrintDAO();
        Twig_Autoloader::register();
        $this->loader = new Twig_Loader_Filesystem('view');
        $this->templateEngine = new Twig_Environment($this->loader);
    }
}