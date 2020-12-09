<?php
/**
 * Auteur : Hugo Ducommun
 * Date: 13.11.2020
 * Classe abstraite regroupant les méthodes à avoir dans chaque repository
 */

abstract class Model {

    protected $pdo;

    /**
     * Effectue une requête à la base de donnée sans where
     *
     * @param string $query Requête SQL sous forme de string
     * @return void
     */
    protected function querySimpleExecute($query) {
        $req = $this->pdo->prepare($query);
        $req->execute();
        return $req;
    }

    /**
     * Effectue une requête à la base de donnée avec des bind values
     *
     * @param string $query Requête SQL avec la syntaxe (idTeacher = :varId)
     * @param array $binds Tableau de trois éléments respectivement : nom du paramètre, valeur du paramètre, type du paramètre (PDO)
     * @return void
     */
    protected function queryPrepareExecute($query, $binds) {
        $req = $this->pdo->prepare($query);
        
        foreach ($binds as $bind) {
            $req->bindValue($bind[0], $bind[1], $bind[2]);
        }
        
        $req->execute();
        return $req;
    }

    /**
     * Formatte les données en tableau associatif
     *
     * @param PDOStatement $req Requête SQL à formater après son execute
     * @return array
     */
    protected function formatData($req) {
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Vide le jeu d'enregistrement
     *
     * @param PDOStatement $req Requête SQL à vider
     * @return void
     */
    protected function unsetData($req) {
        $req->closeCursor();
    }
}