<?php

include 'TableGateway.php';

class PictureTableGateway implements TableGateway{

    function __construct() {

      }

    public function getAllPictures() {
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

    public function addPicture()
    {
        // TODO: Implement addPicture() method.
    }

    public function removePicture()
    {
        // TODO: Implement removePicture() method.
    }

    public function updatePicture()
    {
        // TODO: Implement updatePicture() method.
    }

    public function getAllPicturesByCategory($category)
    {
        // TODO: Implement getAllPicturesByCategory() method.
    }
}