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
    
    // find a pseudo 
    public function findOneByPseudo($data)
    {
        $sql = "SELECT * FROM `" . $this->tableName . "` u WHERE u.user_id = :id ";
        return $this->getOneOrNullResult(DAO::select($sql, ['id' => $data], false), $this->className);
    }

    // find a topic 
    public function findOneByTopic($data)
    {
        $sql = "SELECT * FROM `" . $this->tableName . "` u WHERE u.topic_id = :id ";
        return $this->getOneOrNullResult(DAO::select($sql, ['id' => $data], false), $this->className);
    }

    // delete a like on a specific id of topic and user id 
    public function deleteLike($topic, $user)
    {
        $sql = "DELETE FROM `" . $this->tableName . "` WHERE topic_id = ? and user_id = ? ";
        return DAO::delete($sql, [$topic, $user]);
    }

    public function countLike($id)
    {
        $sql = "SELECT COUNT(*) FROM `like` WHERE `topic_id` = ? ";
        return $this->getOneOrNullResult(DAO::select($sql, [$id], false), $this->className);
    }
}

