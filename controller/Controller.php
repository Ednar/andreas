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

    public function getAllPrints() {
        $pictures = $this->model->getAllPrints();
        $template = $this->twig->loadTemplate('test.twig');
        $template->display(array(
           'pictures'=>$pictures
        ));
    }

    public function showStart() {
        $template = $this->twig->loadTemplate('start.twig');
        $template->display(array());
    }


    public function testPrintInfo() {
        $template = $this->twig->loadTemplate('print_info.twig');
        $template->display(array());
    }

}