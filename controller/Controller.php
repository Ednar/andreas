<?php

require_once 'twig/lib/Twig/Autoloader.php';
require_once 'model/PictureTableGateway.php';

class Controller {

    private $model;
    private $loader;
    private $twig;

    public function __construct() {
        $this->model = new PictureTableGateway();

        Twig_Autoloader::register();
        $this->loader = new Twig_Loader_Filesystem('view');
        $this->twig = new Twig_Environment($this->loader);
    }

    public function getAllPictures() {
        $pictures = $this->model->getAllPictures();
        $template = $this->twig->loadTemplate('test.twig');
        $template->display(array(
           'pictures'=>$pictures
        ));
    }

}