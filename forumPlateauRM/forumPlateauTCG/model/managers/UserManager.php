<?php

namespace Model\Managers;

//on utilise DAO pour ce connecter a la base de donnée
use App\DAO;

//on utilise App/manager ca c'est lui qui execute toute les requete sql !
use App\Manager;



class UserManager extends Manager
{

    protected $className = "Model\Entities\User";
    protected $tableName ="user";



    public function __construct()
    {
        parent::connect();
    }



    public function findOneByUserName($data)
    {
        $sql = "SELECT userName, id_user, role, password
        FROM ".$this->tableName." u
        WHERE u.userName = :userName
        ";
        return $this->getOneOrNullResult
        (
            DAO::select($sql, ['userName' => $data], false), 
            $this->className
        );
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

}
