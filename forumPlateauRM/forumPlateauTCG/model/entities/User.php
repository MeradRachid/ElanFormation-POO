<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity
    {
        private $id;
        private $userName;
        private $registerDate;
        private $role;
        private $email;
        private $password;

        public function __construct($data)
        {         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of (user) id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of (user) id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of userName
         */ 
        public function getUserName()
        {
                return $this->userName;
        }

        /**
         * Set the value of userName
         *
         * @return  self
         */ 
        public function setUserName($userName)
        {
                $this->userName = $userName;

                return $this;
        }

        public function getRegisterDate()
        {
            $formattedDate = $this->registerDate->format("l/d/M/Y - H:i:s");
            return $formattedDate;
        }

        public function setRegisterDate($date)
        {
            $this->registerDate = new \DateTime($date);
            return $this;
        }
    
        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

     
        public function setRole($role)
        { 
                $this->role = json_decode($role);
                 if(empty($this->role))
                 { 
                        $this->role[] = "ROLE_USER"; 
                 } 
        } 
        
        public function hasRole($role)
        {
                $result = $this->role == $role; 
                return $result; 
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

    }

?>