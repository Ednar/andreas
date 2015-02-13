<?php

include 'AbstractDAO.php';
include 'MySQLConnectionManager.php';

class PrintDAO extends AbstractDAO {

    public function getAllPrints() {
        $sql = '
            SELECT *
            FROM Print
            LEFT JOIN Image
            ON Image.imageID = Print.imageID'
        ;
        return $this->databaseManager->request($sql, array(), 'fetchAll');
    }

    public function getPrint($printID) {
        $sql = 'SELECT * FROM Print
                LEFT JOIN Image
                ON Image.imageID = Print.imageID
                LEFT JOIN SizeToPrint
                ON Print.printID = SizeToPrint.printID
                LEFT JOIN Size
                ON Size.sizeID = SizeToPrint.sizeID
                WHERE Print.printID = :printID'
        ;
        $inputParams = array(
            ':printID' => $printID
        );
        return $this->databaseManager->request($sql, $inputParams, "fetch");
    }

    public function insertPrint($name, $description, $price, $pictureID) {
        $sql = 'INSERT into Print (name, description, price, pictureID)'
                . 'VALUES (:name, :description, :price, :pictureURL)';
        $inputParams = array(
            ':name' => $name,
            'description' => $description,
            ':price' => $price,
            'pictureURL' => $pictureID);
        $this->database->push($sql, $inputParams);
    }

    public function getSizeForPrint($printID) {
        $sql = 'SELECT * FROM Size LEFT JOIN PrintToSize ON Size.sizeID = PrintToSize.sizeID
        WHERE PrintToSize.printID = :printID';
        return $this->databaseManager->request($sql, array(':printID' => $printID), 'fetchAll');
    }

    public function getPrintsByCategory($category) {
        $sql = 'SELECT * FROM Print WHERE Category_categoryID IN( '
                . 'SELECT categoryID FROM Category WHERE name = :category)';
        return $this->database->request($sql, array('categoryID' => $category), 'fetchAll');
    }

    public function deletePrint($printID) {
        $sql = 'DELETE FROM Print WHERE printID = :printID';
        $this->database->push($sql, array(':printID' => $printID));
    }

    public function updatePrint($printID, $name, $description, $price, $pictureID) {
        $sql = 'UPDATE Print SET name = :name, description = :description, '
                . 'price = :price, pictureID = :pictureID WHERE printID = :printID';
        $inputParameters = array(
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':pictureID' => $pictureID,
            'printID' => $printID);
        $this->database->push($sql, $inputParameters);
    }

    public function getAllFrames() {
        $sql = 'SELECT * FROM Frame';
        return $this->databaseManager->request($sql, array(), 'fetchAll');
    }
    
    /*
     * Media library functions, yay
     */
    
    public function getMediaLibrary() {
        $sql = 'SELECT * FROM picture';
        return $this->database->request($sql, array(), 'fetchAll');
    }
    
    public function insertPictureToLibrary($url, $alt) {
        $pdo = $this->database->connect();
        $sql = 'INSERT INTO picture (url, alt) VALUES(:url, :alt)';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':url', $url, PDO::PARAM_STR);
        $statement->bindParam(':alt', $alt, PDO::PARAM_STR);
        $target = "img/";
        // Vad händer här? //
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target . $url);
        $statement->execute();
        $pdo = NULL;
    }
    
    public function deletePictureFromLibrary($pictureID) {
        $sql = 'DELETE FROM picture WHERE pictureID = :pictureID';
        $this->database->push($sql, array(':pictureID' => $pictureID));
    }
    
    public function updatePictureInLibrary($pictureID, $url, $alt) {
        $sql = 'UPDATE picture SET url = :url, alt = :alt WHERE pictureID = :pictureID';
        $inputParams = array(
            ':pictureID' => $pictureID,
            ':url' => $url,
            ':alt' => $alt);
        $this->database->push($sql, $inputParams);
    }
}
