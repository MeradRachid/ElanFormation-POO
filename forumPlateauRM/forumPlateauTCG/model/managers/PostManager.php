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



        public function findUserById($id)
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



        // public function findByTopic($idTopic, $idPost)
        // {
        //     $sql = "SELECT *
        //             FROM ".$this->tableName." p
        //             WHERE topic_id = :topicid AND post_id = :postid ORDER BY creationDate DESC";
        //     return $this->getMultipleResults
        //     (
        //         DAO::select($sql, ['topicid' => $idTopic, 'postid' => $idPost]), 
        //         $this->className
        //     );
        // }
    


        public function findByTopic($idTopic)
        {
            $sql = "SELECT *
                    FROM ".$this->tableName." p
                    WHERE topic_id = :topicid
                    ORDER BY creationDate DESC";
            return $this->getMultipleResults
            (
                DAO::select($sql, ['topicid' => $idTopic]), 
                $this->className
            );
        }
        

        public function addPost($topicId, $userId, $message)
        {
            $data = [
                "topic_id" => $topicId,
                "user_id" => $userId,
                "message" => $message
            ];
            $this->add($data);
        }

        
        
    }