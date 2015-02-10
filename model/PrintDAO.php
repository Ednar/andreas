<?php

include 'IDAO.php';
include 'IConnectionManager.php';
include 'MySQLConnectionManager.php';

class PrintDAO implements IDAO {

    private $database;

    public function __construct() {
        try {
            $this->database = new MySQLConnectionManager();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insertPrint($name, $description, $price, $pictureID) {
        $pdo = $this->database->connect();
        $sql = 'INSERT into Print (name, description, price, pictureID)'
                . 'VALUES (:name, :description, :price, :pictureURL)';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':price', $price, PDO::PARAM_STR);
        $statement->bindParam(':pictureURL', $pictureID, PDO::PARAM_STR);
        $statement->execute();
        $pdo = NULL;
    }

    public function getAllPrints() {
        $pdo = $this->database->connect();
        $sql = '
            SELECT *
            FROM Print
            LEFT JOIN picture
            ON picture.pictureID = Print.pictureID'
        ;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $allPrints = $statement->fetchAll(PDO::FETCH_ASSOC);
        $pdo = NULL;
        return $allPrints;
    }

    public function getPrint($printID) {
        $pdo = $this->database->connect();
        $sql = 'SELECT * FROM Print
                LEFT JOIN picture
                ON picture.pictureID = Print.pictureID
                WHERE Print.printID = :printID'
        ;
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':printID', $printID, PDO::PARAM_STR);
        $statement->execute();
        $print = $statement->fetch();
        $pdo = NULL;
        return $print;
    }

    public function getSizeForPrint($printID) {
        $pdo = $this->database->connect();
        $sql = 'SELECT * FROM Size LEFT JOIN PrintToSize ON Size.sizeID = PrintToSize.sizeID
        WHERE PrintToSize.printID = :printID'
        ;
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':printID', $printID, PDO::PARAM_STR);
        $statement->execute();
        $sizes = $statement->fetchAll();
        $pdo = NULL;
        return $sizes;
    }

    public function getPrintsByCategory($category) {
        $pdo = $this->database->connect();
        $sql = 'SELECT * FROM Print WHERE Category_categoryID IN( '
                . 'SELECT categoryID FROM Category WHERE name = :category)';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':category', $category, PDO::PARAM_STR);
        $statement->execute();
        $printsByCategory = $statement->fetchAll();
        $pdo = NULL;
        return $printsByCategory;
    }

    public function deletePrint($printID) {
        $pdo = $this->database->connect();
        $sql = 'DELETE FROM Print WHERE printID = :printID';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':printID', $printID, PDO::PARAM_STR);
        $statement->execute();
        $pdo = NULL;
    }

    public function updatePrint($printID, $name, $description, $price, $pictureID) {
        $pdo = $this->database->connect();
        $sql = 'UPDATE Print SET name = :name, description = :description, '
                . 'price = :price, pictureID = :pictureID WHERE printID = :printID';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':price', $price, PDO::PARAM_STR);
        $statement->bindParam(':pictureID', $pictureID, PDO::PARAM_STR);
        $statement->bindParam(':printID', $printID, PDO::PARAM_STR);
        $statement->execute();
        $pdo = NULL;
    }



    public function getAllFrames() {
        $pdo = $this->database->connect();
        $sql = 'SELECT * FROM Frame';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $frames = $statement->fetchAll();
        $pdo = null;
        return $frames;
    }
    
    /*
     * Media library functions, yay
     */
    
    public function getMediaLibrary() {
        $pdo = $this->database->connect();
        $sql = 'SELECT * FROM picture';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $library = $statement->fetchAll();
        $pdo = NULL;
        return $library;
    }
    
    public function insertPictureToLibrary($url, $alt) {
        $pdo = $this->database->connect();
        $sql = 'INSERT INTO picture (url, alt) VALUES(:url, :alt)';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':url', $url, PDO::PARAM_STR);
        $statement->bindParam(':alt', $alt, PDO::PARAM_STR);
        $statement->execute();
        $pdo = NULL;
    }
    
    public function deletePictureFromLibrary($pictureID) {
        $pdo = $this->database->connect();
        $sql = 'DELETE FROM picture WHERE pictureID = :pictureID';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':pictureID', $pictureID, PDO::PARAM_STR);
        $statement->execute();
        $pdo = NULL;
    }
    
    public function updatePictureInLibrary($pictureID, $url, $alt) {
        $pdo = $this->database->connect();
        $sql = 'UPDATE picture SET url = :url, alt = :alt WHERE pictureID = :pictureID';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':pictureID', $pictureID, PDO::PARAM_STR);
        $statement->bindParam(':url', $url, PDO::PARAM_STR);
        $statement->bindParam(':alt', $alt, PDO::PARAM_STR);
        $statement->execute();
        $pdo = NULL;
    }


}
