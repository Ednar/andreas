<?php

/**
 * Class CategoriesDAO
 */
class CategoriesDAO extends BaseDAO {

    /**
     * @return mixed
     */
    public function getAllCategories() {
        $sql = '
            SELECT *
            FROM Category';
        $statement = self::$pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}