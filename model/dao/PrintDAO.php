<?php

include 'BaseDAO.php';

/**
 * Class PrintDAO
 */
class PrintDAO extends BaseDAO {

    /**
     * @return mixed
     */
    public function getAllPrints() {
        $sql = '
            SELECT *
            FROM Print
            LEFT JOIN Image
            ON Image.imageID = Print.imageID';
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
                WHERE Print.printID = :printID';
        $statement = self::$pdo->prepare($sql);
        $inputParams = array(
            ':printID' => $printID
        );
        $statement->execute($inputParams);
        return $statement->fetch();
    }

    /**
     * @param $name
     * @param $description optional description
     * @param $price
     * @param $pictureID
     */
    public function insertPrint($name, $description, $pictureID) {
        $sql = 'INSERT into Print (name, description, price, pictureID)'
                . 'VALUES (:name, :description, :price, :pictureURL)';
        $statement = self::$pdo->prepare($sql);
        $inputParams = array(
            ':name' => $name,
            'description' => $description,
            'pictureURL' => $pictureID);
        $statement->execute($inputParams);
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
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array(':printID' => $printID));
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
        $statement = self::$pdo->prepare($sql);
        $inputParameters = array(
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':pictureID' => $pictureID,
            'printID' => $printID);
        $statement->execute($inputParameters);
    }

    /*
     * Media library functions
     */

    /**
     * @return mixed
     */
    public function getMediaLibrary() {
        $sql = 'SELECT * FROM picture';
        $statement = self::$pdo->prepare($sql);
        return $statement->execute();
    }

    /**
     * @param $url
     * @param $alt
     */
    public function insertPictureToLibrary($url, $alt) {
        $sql = 'INSERT INTO picture (url, alt) VALUES(:url, :alt)';
        $statement = self::$pdo->prepare($sql);
        $target = "img/";
        // Vad händer här? //
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target . $url);
        $inputParams = array(':url' => $url, ':alt' => $alt);
        $statement->execute($inputParams);
    }

    /**
     * @param $pictureID
     */
    public function deletePictureFromLibrary($pictureID) {
        $sql = 'DELETE FROM picture WHERE pictureID = :pictureID';
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array(':pictureID' => $pictureID));
    }

    /**
     * @param $pictureID
     * @param $url
     * @param $alt
     */
    public function updatePictureInLibrary($pictureID, $url, $alt) {
        $sql = 'UPDATE picture SET url = :url, alt = :alt WHERE pictureID = :pictureID';
        $statement = self::$pdo->prepare($sql);
        $inputParams = array(
            ':pictureID' => $pictureID,
            ':url' => $url,
            ':alt' => $alt);
        $statement->execute($inputParams);
    }
}