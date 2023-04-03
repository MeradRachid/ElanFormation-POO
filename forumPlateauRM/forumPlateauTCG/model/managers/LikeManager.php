<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class LikeManager extends Manager
{
    protected $className = "Model\Entities\Like";
    protected $tableName = "like";
    public function __construct()
    {
        parent::connect();
    }



    // find a topic 
    public function findOneByTopic($data)
    {
        $sql = "SELECT * FROM `" . $this->tableName . "` u WHERE u.topic_id = :id ";
        return $this->getOneOrNullResult(DAO::select($sql, ['id' => $data], false), $this->className);
    }


    // find a pseudo 
    public function findOneByPseudo($user, $topic)
    {
        $sql = "SELECT * FROM `" . $this->tableName . "` u WHERE u.user_id = ? AND u.topic_id = ? ";
        return $this->getOneOrNullResult(DAO::select($sql, [$user, $topic], false), $this->className);
    }



    public function countLikes($topicID)
    {
        $sql = "SELECT COUNT(*) FROM `" . $this->tableName . "` l WHERE l.topic_id = ?";
        return $this->getSingleScalarResult(DAO::select($sql, [$topicID], false));
    }

    // delete a like on a specific id of topic and user id 
    public function deleteLike($topic, $user)
    {
        $sql = "DELETE FROM `" . $this->tableName . "` WHERE topic_id = ? and user_id = ? ";
        return DAO::delete($sql, [$topic, $user]);
    }

}