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
     * @param $category
     * @return mixed
     */
    public function getPrintsByCategory($category) {
        $sql = 'SELECT *
                FROM Print
                LEFT JOIN Image
                ON Image.imageID = Print.imageID
                WHERE Print.categoryID = :categoryID';
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array(':categoryID' => $category));
        return $statement->fetchAll();
    }

    /**
     * @param $printID
     * @return mixed
     */
    public function getPrintByID($printID) {
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
     * @param $title
     * @return mixed
     */
    public function getPrintIDByTitle($title) {
        $sql = 'SELECT printID FROM Print WHERE title = :title';
        $statement = self::$pdo->prepare($sql);
        $inputParams = array(
            ':title' => $title
        );
        $statement->execute($inputParams);
        return $statement->fetch()[0];
    }

    public function insertPrint($title, $description, $imageID, $categoryID) {
        $sql = 'INSERT into Print (title, description, imageID, categoryID)'
                . 'VALUES (:title, :description, :imageID, :categoryID)';
        $statement = self::$pdo->prepare($sql);
        $inputParams = array(
            ':title' => $title,
            ':description' => $description,
            ':imageID' => $imageID,
            ':categoryID' => $categoryID
         );
        $statement->execute($inputParams);
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

    /**
     * @param $printID
     * @param $imageID
     */
    public function deletePrint($printID) {
        $sql = 'DELETE FROM Print,SizeToPrint WHERE printID = :printID';
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array(':printID' => $printID));
    }

    public function deleteImage($imageID) {
        $sql = 'DELETE FROM Image WHERE imageID = :imageID';
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array(':imageID' => $imageID));
    }
}