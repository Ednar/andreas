<?php

/**
 * Class CategoriesDAO
 */
final class CategoriesDAO extends BaseDAO {

    /**
     * @return mixed the names and IDs of all categories
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