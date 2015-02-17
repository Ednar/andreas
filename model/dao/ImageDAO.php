<?php

class ImageDAO extends BaseDAO {

    public function insertImage($name, $alt) {
        $sql = 'INSERT INTO Image (fullSize, alt) VALUES(:fullSize, :alt)';
        $statement = self::$pdo->prepare($sql);
        $inputParams = array(':fullSize' => $name, ':alt' => $alt);
        $statement->execute($inputParams);
    }

    public function getImageID($name) {
        $sql = 'SELECT imageID FROM Image
                WHERE fullSize = :fullSize';
        $statement = self::$pdo->prepare($sql);
        $inputParams = array(':fullSize' => $name);
        $statement->execute($inputParams);
        return $statement->fetch()[0];
    }

}