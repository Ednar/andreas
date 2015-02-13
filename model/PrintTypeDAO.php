<?php

class PrintTypeDAO extends AbstractDAO {

    public function getAllPrintTypes() {
        $sql = 'SELECT * FROM PrintType';
        return $this->databaseManager->request($sql, array(), 'fetchAll');
    }

    public function getPrintTypeByID($typeID) {
        $sql = 'SELECT type FROM PrintType WHERE printTypeID = :typeID';
        return $this->databaseManager->request($sql, array('typeID' => $typeID), 'fetch');
    }
}