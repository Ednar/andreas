<?php

require_once 'twig/lib/Twig/Autoloader.php';
require_once 'model/PrintDAO.php';
require_once 'model/ShoppingCart.php';
require_once 'model/Product.php';
session_start();

class Controller {

    private $model;
    private $loader;
    private $twig;

    private $shoppingCart;

    public function __construct() {
        $this->shoppingCart = array();
        $this->model = new PrintDAO();

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
        $frames = $this->model->getAllFrames();
        $sizes = $this->model->getSizeForPrint($printID);
        $template = $this->twig->loadTemplate('print_info.twig');
        $template->display(array(
            'print' => $printInfo,
            'frames' => $frames,
            'sizes' => $sizes
        ));
    }

    public function addToCart() {
        $this->savePrintInCart($_POST['printID']);

        if ($_SESSION['shopping_cart']) {
            $this->shoppingCart = $_SESSION['shopping_cart'];
            if (!array_key_exists($_POST['printID'], $this->shoppingCart)) {
                $_SESSION['shopping_cart'] = $this->shoppingCart;
            }
        } else {
            $_SESSION['shopping_cart'] = $this->shoppingCart;
        }
        $template = $this->twig->loadTemplate('shopping_cart.twig');
        $template->display(array(
            'cart' => $this->shoppingCart
        ));
    }

    private function savePrintInCart($printID) {
        $print = $this->model->getPrint($printID);
        $print['frameID'] = $_POST['frameID'];
        $print['sizeID'] = $_POST['sizeID'];
        $this->shoppingCart[$print[$_POST['printID']]] = $print;
    }

}