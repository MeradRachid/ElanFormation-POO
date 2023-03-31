<?php
    namespace Model\Entities;

    use App\Entity;

    final class Like extends Entity
    {
        private $status;
        private $topic;
        private $user;

        public function __construct($data)
        {         
            $this->hydrate($data);        
        }
 

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setStatus($status)
        {
                $this->status = $status;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }

        public function getCreationDate()
        {
            $formattedDate = $this->creationDate->format("l/d/M/Y - H:i:s");
            return $formattedDate;
        }

        public function setCreationDate($date)
        {
            $this->creationDate = new \DateTime($date);
            return $this;
        }
    
        /**
         * Get the value of topic
         */ 
        public function getTopic()
        {
                return $this->topic;
        }

        /**
         * Set the value of topic
         *
         * @return  self
         */ 
        public function setMessage($topic)
        {
                $this->topic = $topic;

                return $this;
        }
    }

?>