<?php

/**
 * ETML
 * Auteur :  Hugo Ducommun
 * Date: 09.11.2020
 * Classe gérant la base de données du fil rouge du module 151
 */

include_once "Model.php";
include_once "../../config.ini.php";

class Database extends Model
{
    /**
     * Constructeur
     */
    public function __construct()
    {
        $dbname = $GLOBALS['database']['dbname'];
        $username = $GLOBALS['database']['username'];
        $password = $GLOBALS['database']['password'];
        $host = $GLOBALS['database']['host'];
        $port = $GLOBALS['database']['port'];
        $charset = $GLOBALS['database']['charset'];

        try {
            $this->pdo = new PDO(
                'mysql:host=' . $host .
                ';port=' . $port .
                ';dbname=' . $dbname .
                ';charset=' . $charset,
                $username, $password);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    /**
     * Retourne un tableau contenant toutes les bases de données.
     * @return array
     */
    public function getDatabases()
    {
        $reqToUse = 'select db from mysql.db where user= :user';
        $values = array(
            1=> array(
                '0' => ':user',
                '1' => $_SESSION["user"],
                '2' => PDO::PARAM_STR
            )
        );
        $req = $this->queryPrepareExecute($reqToUse, $values);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }



    /**
     * Crée une base de données sur le serveur MySQL.
     * @param string $dbname Nom de la base de données à créer.
     * @return void
     */
    public function createDatabase($dbname){
        $req = $this->querySimpleExecute("create database ".$_SESSION["user"]."_".$dbname);
        $this->addPermission($dbname);
    }

    /**
     * Retourne tous les enseignants
     *
     * @return array
     */
    public function verifUser($user, $password){
        $reqToUse = "Select eleUsername from db_users.t_eleves where eleUsername = :user and elePassword= :password";
        $values = array(
            1=> array(
                '0' => ':user',
                '1' => $user,
                '2' => PDO::PARAM_STR
            ),
            2=> array(
                '0' => ':password',
                '1' => $password,
                '2' => PDO::PARAM_STR
            )
        );
        $req = $this->queryPrepareExecute($reqToUse, $values);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    
    /**
     * Ajout les permission de modifié une DB
     *
     * @return array
     */
    public function addPermission($dbname){
        $queryToUse = 'GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON '.$dbname.'.* TO '.$_SESSION["user"].'@"%"';
        $req = $this->querySimpleExecute($queryToUse);
    }


    /**
     * Supprimer une database
     *
     * @return void
     */
    public function deleteDataBase($dbname)
    {
        // Vérifie si l'utilisateur possède bien des droits sur la DB
        $myData = false;
        foreach($this->getDatabases() as $database)
        {
            if($database['db'] == $dbname)
            {
                $myData = true;
            }
        }

        if($myData)
        {
            $queryToUse ="DROP DATABASE $dbname";

            $req = $this->querySimpleExecute($queryToUse);
            $this->unsetData($req);
            $this->revokPrivileges($dbname);
        }

    }

    /**
     * Revoque les privilèges d'un utilisateur pour une db
     *
     * @return void
     */
    public function revokPrivileges($dbname)
    {
        $user = $_SESSION['user'];
        $queryToUse ="REVOKE ALL PRIVILEGES ON $dbname.* FROM $user@'%'";

        $req = $this->querySimpleExecute($queryToUse);
        $this->unsetData($req);
    }

    /**
     * Permets de retrouver un ID avec un pseudo.
     * @param string $elePseudo Pseudo de l'utilisateur
     * @return array
     */
    public function getIdByUsername($elePseudo)
    {
        $req = $this->querySimpleExecute("SELECT idEleve FROM t_eleves WHERE elePseudo='$elePseudo'");
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }
}