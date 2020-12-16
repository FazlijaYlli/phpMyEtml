<?php

/**
 * ETML
 * Auteur :  Hugo Ducommun
 * Date: 09.11.2020
 * Classe gérant la base de données du fil rouge du module 151
 */

include_once "Model.php";


class Database extends Model
{

    /**
     * Constructeur
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . $_SESSION['address'] .
                ';dbname=mysql;charset=utf8',
                $_SESSION['user'], $_SESSION['password']);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    /**
     * Retourne tous les enseignants
     *
     * @return array
     */
    public function getDatabases()
    {
        $req = $this->querySimpleExecute("Show databases");
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    public function customQuery($query)
    {
        $req = $this->querySimpleExecute($query);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    /**
     * Retourne tous les enseignants
     *
     * @return array
     */
    public function createDatabase($dbname){
        $req = $this->querySimpleExecute("create database ".$dbname);
    }

    public function insertData($file){
        $req = $this->querySimpleExecute("LOAD DATA INFILE ".$file." ");
    }





}


?>