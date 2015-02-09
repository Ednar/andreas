<?php

require_once 'twig/lib/Twig/Autoloader.php';
require_once 'model/PrintDAO.php';
require_once 'model/ShoppingCart.php';
require_once 'model/Product.php';

class Controller {

    private $model;
    private $loader;
    private $twig;

    private $shoppingCart;

    public function __construct() {
        $this->model = new PrintDAO();
        $this->shoppingCart = new ShoppingCart();

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


    public function printInfo($printID) {
        $printInfo = $this->model->getPrint($printID);
        $print = new Product($printInfo);
        echo $this->print->getName();
        $frames = $this->model->getAllFrames();
        $sizes = $this->model->getSizeForPrint($printID);
        $template = $this->twig->loadTemplate('print_info.twig');
        $template->display(array(
            $print,
            'print' => $printInfo,
            'frames' => $frames,
            'sizes' => $sizes
        ));
    }

    public function shopping_cart($print) {
        $print->setFrame($_POST['frameID']);
        $print->setSize($_POST['sizeID']);
        $this->shoppingCart->addProduct($print);
        $template = $this->twig->loadTemplate('shopping_cart.twig');
        $template->display(array(
            'cart' => $this->shoppingCart
        ));
    }

}