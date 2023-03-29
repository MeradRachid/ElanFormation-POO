<?php
    namespace Model\Managers;
    //on utilise dao pour ce connecter a la base de donnée

    use App\DAO;
    //on utilise App/manager ca c'est lui qui execute toute les requete sql !
    use App\Manager;



    class CategoryManager extends Manager
    {
        protected $className = "Model\Entities\Category";
        protected $tableName ="category";

        public function __construct()
        {
            parent::connect();
        }

        public function findTopicsById($id)
        {
            $sql = "SELECT *
            FROM ".$this->tableName." a
            WHERE a.id_".$this->tableName." = :id
            ";
            return $this->getOneOrNullResult
            (
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

    }

