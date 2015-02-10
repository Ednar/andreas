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
        $this->showCart();
    }

    private function savePrintInCart($printID) {
        $this->getCartIfSet();
        $print = $this->model->getPrint($printID);


        // TODO fixa det här
        $frames = $this->model->getAllFrames();
        $print['frame'] = $frames[$_POST['frameID']];

        $sizes = $this->model->getSizeForPrint($printID);
        $print['size'] = $sizes[0][1];
        foreach ($this->$sizes as $size){
           echo $size;
            if ($size[0] = $printID)
                echo $size[1];
                echo $size[2];
        }
        echo $sizes[0][1];
        echo $sizes[0][2];

        $print['frameID'] = $_POST['frameID'];
        $print['sizeID'] = $_POST['sizeID'];
        $print['amount'] = 1;

        $uniqueID = $printID.$print['frameID'].$print['sizeID'];
        $uniqueID = trim($uniqueID);
        if (isset($this->shoppingCart[$uniqueID])) {
            $this->shoppingCart[$uniqueID]['amount']++;
        } else {
            $this->shoppingCart[$uniqueID] = $print;
        }
        $this->saveCartToSession();

    }

    private function getCartIfSet() {
        if (isset($_SESSION['shopping_cart'])) {
            $this->shoppingCart = $_SESSION['shopping_cart'];
        } else {
            $_SESSION['shopping_cart'] = $this->shoppingCart;
        }
    }

    private function saveCartToSession() {
        $_SESSION['shopping_cart'] = $this->shoppingCart;
    }

    public function showCart() {
        $this->getCartIfSet();
        $sum = 0;
        foreach ($this->shoppingCart as $row) {
            $sum += $row['price'] * $row['amount'];
        }
        if (empty($this->shoppingCart)) {
            $template = $this->twig->loadTemplate('empty_cart.twig');
        } else {
            $template = $this->twig->loadTemplate('shopping_cart.twig');
        }
        $template->display(array(
            'cart' => $this->shoppingCart,
            'sum' => $sum
        ));
    }

    public function decreaseAmount($uniqueID) {
        $this->getCartIfSet();
        if (isset($this->shoppingCart[$uniqueID])) {
            $this->shoppingCart[$uniqueID]['amount']--;
            if ( $this->shoppingCart[$uniqueID]['amount'] <= 0) {
                unset( $this->shoppingCart[$uniqueID]);
            }
        }
        $this->saveCartToSession();
        $this->showCart();
    }

    public function increaseAmount($uniqueID) {
        $this->getCartIfSet();
        if (isset($this->shoppingCart[$uniqueID])) {
            $this->shoppingCart[$uniqueID]['amount']++;
        }
        $this->saveCartToSession();
        $this->showCart();
    }

    public function nuke() {
        session_unset();
        session_destroy();
    }


}