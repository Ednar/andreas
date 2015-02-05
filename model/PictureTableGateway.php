<?php

include 'TableGateway.php';

class PictureTableGateway implements ITableGateway {

    function __construct() {
        
    }

    public function insertPrint($name, $description, $price, $pictureURL) {
        $pdo = DBConncetion::connect();
        $sql = 'INSERT into Print (name, description, price, pictureURL)'
                . 'VALUES (:name, :description, :price, :pictureURL)';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':price', $price, PDO::PARAM_STR);
        $statement->bindParam(':pictureURL', $pictureURL, PDO::PARAM_STR);
        $statement->execute();
        $pdo = NULL;
    }

    public function getAllPrints() {
        $pdo = DBConncetion::connect();
        $sql = 'SELECT * FROM Print';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $allPrints = $statement->fetchAll(PDO::FETCH_ASSOC);
        $pdo = NULL;
        return $allPrints;
    }

    public function getPrint($printID) {
        $pdo = DBConncetion::connect();
        $sql = 'SELECT * FROM Print WHERE printID = :printID';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':printID', $printID, PDO::PARAM_STR);
        $statement->execute();
        $print = $statement->fetch(PDO::FETCH_ASSOC);
        $pdo = NULL;
        return $print;
    }

    public function getPrintsByCategory($category) {
        $pdo = DBConncetion::connect();
        $sql = 'SELECT * FROM Print WHERE Category_categoryID IN( '
                . 'SELECT categoryID FROM Category WHERE name = :category)';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':category', $category, PDO::PARAM_STR);
        $statement->execute();
        $printsByCategory = $statement->fetchAll(PDO::FETCH_ASSOC);
        $pdo = NULL;
        return $printsByCategory;
    }

    public function deletePrint($printID) {
        $pdo = DBConncetion::connect();
        $sql = 'DELETE FROM Print WHERE printID = :printID';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':printID', $printID, PDO::PARAM_STR);
        $statement->execute();
        $pdo = NULL;
    }

    public function updatePrint($printID, $name, $description, $price, $pictureURL) {
        $pdo = DBConncetion::connect();
        $sql = 'UPDATE Print SET name = :name, description = :description, '
                . 'price = :price, pictureURL = :pictureURL WHERE printID = :printID';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':price', $price, PDO::PARAM_STR);
        $statement->bindParam(':pictureURL', $pictureURL, PDO::PARAM_STR);
        $statement->bindParam(':printID', $printID, PDO::PARAM_STR);
        $statement->execute();
        $pdo = NULL;
    }

}