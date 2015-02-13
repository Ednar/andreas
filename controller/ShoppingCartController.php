<?php


class ShoppingCartController extends BaseController {

    private $shoppingCart;
    private $printDAO;
    private $sizeDAO;
    private $printTypeDAO;

    protected function initialize()
    {
        $this->shoppingCart = array();
        $databaseManager = new MySQLConnectionManager();
        $this->printDAO = new PrintDAO($databaseManager);
        $this->sizeDAO = new SizeDAO($databaseManager);
        $this->printTypeDAO = new PrintTypeDAO($databaseManager);
    }


    public function addToCart() {
        $this->getCartIfSet();

        $printID = $_POST['printID'];
        $print = $this->printDAO->getPrint($printID);

        $print['printTypeID'] = $_POST['printTypeID'];
        $print['sizeID'] = $_POST['sizeID'];
        $print['size'] = $this->sizeDAO->getSize($_POST['sizeID']);
        $print['type'] = $this->printTypeDAO->getPrintTypeByID($_POST['printTypeID']);
        $print['amount'] = 1;

        $uniqueID = $printID.$print['printTypeID'].$print['sizeID'];
        $uniqueID = trim($uniqueID);

        if (isset($this->shoppingCart[$uniqueID])) {
            $this->shoppingCart[$uniqueID]['amount']++;
        } else {
            $this->shoppingCart[$uniqueID] = $print;
        }
        $this->saveCartToSession();
        $this->showCart();
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