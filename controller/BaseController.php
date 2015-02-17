<?php

require_once 'twig/lib/Twig/Autoloader.php';
require_once 'model/dao/PrintDAO.php';

/**
 * Class BaseController
 *
 * Inheriting from the BaseController ensures that the template engine
 * gets set up correctly for each controller
 */
class BaseController {

    /**
     * @var Twig_Loader_Filesystem File system for the view directory
     */
    protected $loader;

    /**
     * @var Twig_Environment the template engine for loading and
     * displaying the templates
     */
    protected $templateEngine;

    public function __construct() {
        Twig_Autoloader::register();
        $this->loader = new Twig_Loader_Filesystem('view');
        $this->templateEngine = new Twig_Environment($this->loader);
    }
}