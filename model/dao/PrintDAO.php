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
     * @param $title
     * @param $description optional description
     * @param $categoryID
     */
    public function updateSelectedPrint($printID, $title, $description, $categoryID) {
        $sql = 'UPDATE Print SET title = :title, description = :description, '
                . 'categoryID = :categoryID WHERE printID = :printID';
        $statement = self::$pdo->prepare($sql);
        $inputParameters = array(
            ':printID' => $printID,
            ':title' => $title,
            ':description' => $description,
            ':categoryID' => $categoryID
        );
        $statement->execute($inputParameters);
    }

    /**
     * @param $printID
     */
    public function deletePrint($printID) {
        $sql = 'DELETE FROM Print WHERE printID = :printID';
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array(':printID' => $printID));
    }

    public function deleteImageFromFilesystem($printID) {
       $sql = 'select fullSize from Image
                WHERE imageID IN (SELECT imageID FROM Print where printID = :printID)';
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array(':printID' => $printID));
        $fileName = $statement->fetchColumn();
        $target = 'img/printImg/' . $fileName;


        if (file_exists($target)) {
            unlink($target);
            echo 'File '.$fileName.' has been deleted';
        } else {
            echo 'Could not delete '.$fileName.', file does not exist';
        }

    }
}