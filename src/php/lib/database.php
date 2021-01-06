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
                'mysql:host=' . $_SESSION['address'] . ';dbname=db_support;charset=utf8', $_SESSION['user'], $_SESSION['password']);
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
        $req = $this->querySimpleExecute("SHOW DATABASES");
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
        $req = $this->querySimpleExecute("CREATE DATABASE ".$dbname);
        $this->UnsetData($req);
    }

    /**
     * @param int $idEleve ID de l'élève duquel nous souhaitons obtenir ses informations.
     * @return array Tableau d'informations
     */
    public function getOneStudent($idEleve)
    {
        $req = $this->querySimpleExecute("SELECT * FROM t_eleves WHERE idEleve=$idEleve");
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    /**
     * Permets de changer le mot de passe d'un utilisateur.
     * @param int $idEleve Id de l'utilisateur à modifier
     * @param string $newPasswordHash Hash du nouveau mot de passe de l'élève.
     * @return void
     */
    public function changePassword($idEleve, $newPasswordHash)
    {
        $req = $this->querySimpleExecute("UPDATE t_eleves SET elePassword='$newPasswordHash' WHERE idEleve=$idEleve");
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