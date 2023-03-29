<?php
    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity
    {
        private $id;
        private $topic;
        private $user;
        private $creationDate;
        private $message;

        public function __construct($data)
        {         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of (post) id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of (post) id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of title
         */ 
        public function getTopic()
        {
                return $this->topic;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTopic($topic)
        {
                $this->topic = $topic;

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
         * Get the value of message
         */ 
        public function getMessage()
        {
                return $this->message;
        }

        /**
         * Set the value of message
         *
         * @return  self
         */ 
        public function setMessage($message)
        {
                $this->message = $message;

                return $this;
        }
    }

?>