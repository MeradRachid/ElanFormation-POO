<?php

namespace Model\Managers;


use App\Manager;

use App\DAO;



class TopicManager extends Manager
{ // On extends Manager pour pouvoir accéder à ses méthodes publiques 

    protected $className = "Model\Entities\Topic"; // arborescence des namespaces
    protected $tableName = "topic"; // C'est la table à laquelle on veut accéder.  

    /** Pourquoi Protected : 
     * Les propriétés et méthodes définies comme "protected" ne sont accessibles que : 
     * Depuis la classe elle-même et ses sous-classes (héritage)
     * Il est donc courant d'utiliser la portée "protected" : 
     * Pour des propriétés et des méthodes qui doivent être accessibles par les sous-classes du parent,
     * mais qui ne devraient pas être accessibles depuis l'extérieur de la classe ou ses sous-classes. 
     * Cela permet de mieux contrôler l'accès aux données et aux méthodes de la classe.
     * L'utilisation de la portée "protected" peut également faciliter la maintenance du code. 
     * Si une propriété ou une méthode est définie comme "protected" : 
     * Cela signifie que son comportement ne doit pas être modifié à l'extérieur de la classe ou ses sous-classes.
     * Permettant de garantir que le comportement de la classe reste cohérent et prévisible.
     * Et ce, même si des modifications sont apportées à l'implémentation interne de la classe.
     * En résumé, la portée "protected" est utile pour contrôler l'accès aux données et méthodes d'une classe.
     * Et pour faciliter la maintenance du code tout en garantissant la cohérence du comportement de la classe.
     */

    public function __construct()
    {
        parent::connect(); // On utilise le parent pour se connecter grâce à DAO
    }



    public function findByCategory($idCategory)
    {
        $sql = "SELECT *
                FROM ".$this->tableName." p
                WHERE category_id = :id";
    
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $idCategory]), 
            $this->className
        );
    }
    


    public function findPostsById($idPost)
    {
        $sql = "SELECT *
            FROM " . $this->tableName . " a
            WHERE a.id_" . $this->tableName . " = :id
            ";

        return $this->getMultipleResults
        (
            DAO::select($sql, ['id' => $idPost], false),
            $this->className
        );
    }

}
?>