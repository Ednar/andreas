<?php

include 'TableGateway.php';

class PictureTableGateway implements ITableGateway {

    function __construct() {
        
    }

    public function addPrint() {
        
    }

    public function getAllPrints() {
        try {
            $url = 'mysql:host=localhost;dbname=andreas';
            $username = 'andreas';
            $password = 'andreas';
            $pdocon = new PDO($url, $username, $password);
            $pdoStatement = $pdocon->prepare('SELECT * from PICTURES');
            $pdoStatement->execute();

            $pictures = $pdoStatement->fetchAll();
            $pdocon = null;
            return $pictures;
        } catch (PDOException $e) {
            $pdocon = null;
            throw new Exception('Fel någonstans');
        }
    }

    public function getPrint() {
        
    }

    public function getPrintsByCategory($category) {
        
    }

    public function removePrint() {
        
    }

    public function updatePrint() {
        
    }

}
