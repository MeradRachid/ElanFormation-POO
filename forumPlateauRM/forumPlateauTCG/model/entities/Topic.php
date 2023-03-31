<?php
    namespace Model\Entities;

    use App\Entity;

    /**
     * Dans les entities, les propriétés portent le même nom que les champs de la base de données.
     * Sauf pour la clé primaire et les clés étrangères où on enlève le "_id" ou "id_".
     * Chaque Entity va hériter de la classe Entity (dans le dossier App) et toutes les Entities auront exactement le même constructeur : 
     * Il implémente la méthode "hydrate" (de cette même classe Entity)
     */

    final class Topic extends Entity
    {
        private $id;
        private $category;
        private $user;
        private $topicTitle;
        private $creationDate;
        private $topicLocked;
        private $likes;

        public function __construct($data)
        {         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of (topic) id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of (topic) id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

                /**
         * Get the value of category
         */ 
        public function getCategory()
        {
                return $this->category;
        }

        /**
         * Set the value of category
         *
         * @return  self
         */ 
        public function setCategory($category)
        {
                $this->category = $category;

                return $this;
        }

        /**
         * Get the value of title
         */ 
        public function getTopictitle()
        {
                return $this->topicTitle;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTopicTitle($topicTitle)
        {
                $this->topicTitle = $topicTitle;

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
         * Get the value of closed
         */ 
        public function getTopicLocked()
        {
                return $this->topicLocked;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */ 
        public function setTopicLocked($topicLocked)
        {
                $this->topicLocked = $topicLocked;

                return $this;
        }
    

        /**
         * Get the value of likes
         */ 
        public function getLikes()
        {
                return $this->likes;
        }

        /**
         * Set the value of likes
         *
         * @return  self
         */ 
        public function setLikes($likes)
        {
                $this->likes = $likes;

                return $this;
        }
    }

?>