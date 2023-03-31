<?php
    namespace Model\Entities;

    use App\Entity;

    final class Like extends Entity
    {
        private Topic $topic ;
        private User $user;

        public function __construct($data)
        {         
            $this->hydrate($data);        
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
    }

?>