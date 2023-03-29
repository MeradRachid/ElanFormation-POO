<?php
    namespace Model\Managers;
    //on utilise dao pour ce connecter a la base de donnée
    use App\DAO;
    //on utilise App/manager ca c'est lui qui execute toute les requete sql !
    use App\Manager;



    class PostManager extends Manager
    {
        protected $className = "Model\Entities\Post";
        protected $tableName ="post";

        public function __construct()
        {
            parent::connect();
        }

        public function findByTopic($idtopic)
        {
            $sql = "SELECT *
                    FROM ".$this->tableName." p
                    WHERE topic_id = :topicid";
            return $this->getMultipleResults
            (
                DAO::select($sql, ['topicid' => $idtopic]), 
                $this->className
            );
        }
    
    }