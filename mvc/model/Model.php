<?php

/**
 * Description of Model
 *
 * @author noworries
 */

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

include_once 'Prints.php';
include_once 'DBConnection.php';

class Model {
    public function getAllPrints() {
        $pdo = DBConnection::connect();
        $sql = 'SELECT * FROM prints';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $prints = $statement->fetchALL(PDO::FETCH_ASSOC);
        $pdo = NULL;
        if (is_null($prints)) {
            throw new Exception('$prints är == NULL och $sql = ' . $sql);
        }
        return $prints;
    }
    
    public function getPrintByTitle($title) {
        $pdo = DBConnection::connect();
        $sql = 'SELECT * FROM prints WHERE title=:title';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->execute();
        $print = $statement->fetch(PDO::FETCH_ASSOC);
        $pdo = NULL;
        return $print;
    }
}

?>
