<?php


class ShoppingCartController extends BaseController {

    private $shoppingCart;

    public function __construct() {
        $this->shoppingCart = array();
        $this->model = $this->model = new PrintDAO();
        Twig_Autoloader::register();
        $this->loader = new Twig_Loader_Filesystem('view');
        $this->templateEngine = new Twig_Environment($this->loader);
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
            $template = $this->templateEngine->loadTemplate('empty_cart.twig');
        } else {
            $template = $this->templateEngine->loadTemplate('shopping_cart.twig');
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

}