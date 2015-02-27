<?php

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

    }
}