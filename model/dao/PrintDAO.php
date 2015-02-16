<?php

include 'AbstractDAO.php';

class PrintDAO extends BaseDAO {

    /**
     * @return mixed
     */
    public function getAllPrints() {
        $sql = '
            SELECT *
            FROM Print
            LEFT JOIN Image
            ON Image.imageID = Print.imageID'
        ;
        $statement = self::$pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * @param $printID
     * @return mixed
     */
    public function getPrint($printID) {
        $sql = 'SELECT * FROM Print
                LEFT JOIN Image
                ON Image.imageID = Print.imageID
                LEFT JOIN SizeToPrint
                ON Print.printID = SizeToPrint.printID
                LEFT JOIN Category
                ON Print.categoryID = Category.categoryID
                WHERE Print.printID = :printID'
        ;
        $inputParams = array(
            ':printID' => $printID
        );
        $statement = self::$pdo->prepare($sql);
        $statement->execute($inputParams);
        return $statement->fetch();
    }

    /**
     * @param $name
     * @param $description optional description
     * @param $price
     * @param $pictureID
     */
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

    /**
     * @param $category
     * @return mixed
     */
    public function getPrintsByCategory($category) {
        $sql = 'SELECT * FROM Print WHERE Category_categoryID IN( '
                . 'SELECT categoryID FROM Category WHERE name = :category)';
        return $this->database->request($sql, array('categoryID' => $category));
    }

    /**
     * @param $printID
     */
    public function deletePrint($printID) {
        $sql = 'DELETE FROM Print WHERE printID = :printID';
        $this->database->push($sql, array(':printID' => $printID));
    }

    /**
     * @param $printID
     * @param $name
     * @param $description optional description
     * @param $price
     * @param $pictureID
     */
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

    /**
     * @return mixed
     */
    public function getAllFrames() {
        $sql = 'SELECT * FROM Frame';
        return $this->databaseHandle->request($sql, array());
    }
    
    /*
     * Media library functions, yay
     */

    /**
     * @return mixed
     */
    public function getMediaLibrary() {
        $sql = 'SELECT * FROM picture';
        return $this->database->request($sql, array());
    }

    /**
     * @param $url
     * @param $alt
     */
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

    /**
     * @param $pictureID
     */
    public function deletePictureFromLibrary($pictureID) {
        $sql = 'DELETE FROM picture WHERE pictureID = :pictureID';
        $this->database->push($sql, array(':pictureID' => $pictureID));
    }

    /**
     * @param $pictureID
     * @param $url
     * @param $alt
     */
    public function updatePictureInLibrary($pictureID, $url, $alt) {
        $sql = 'UPDATE picture SET url = :url, alt = :alt WHERE pictureID = :pictureID';
        $inputParams = array(
            ':pictureID' => $pictureID,
            ':url' => $url,
            ':alt' => $alt);
        $this->database->push($sql, $inputParams);
    }
}