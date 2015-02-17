<?php

final class ImageDAO extends BaseDAO {

    /**
     * @param $name string name of image to insert
     * @param $alt string alt text (strongly recommended)
     */
    public function insertImage($name, $alt) {
        $sql = 'INSERT INTO Image (fullSize, alt) VALUES(:fullSize, :alt)';
        $statement = self::$pdo->prepare($sql);
        $inputParams = array(':fullSize' => $name, ':alt' => $alt);
        $statement->execute($inputParams);
    }

    /**
     * @param $name string name of image to get ID from
     * @return mixed the ID of the image
     */
    public function getImageID($name) {
        $sql = 'SELECT imageID FROM Image
                WHERE fullSize = :fullSize';
        $statement = self::$pdo->prepare($sql);
        $inputParams = array(':fullSize' => $name);
        $statement->execute($inputParams);
        return $statement->fetch()[0];
    }

}