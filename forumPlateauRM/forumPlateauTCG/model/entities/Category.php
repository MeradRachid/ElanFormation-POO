<?php
    namespace Model\Entities;

    use App\Entity;

    final class Category extends Entity
    {
        private $id;
        private $categoryName;
        private $creationDate;

        public function __construct($data)
        {         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of (category) id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of (category) id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of categoryName
         */ 
        public function getCategoryName()
        {
                return $this->categoryName;
        }

        /**
         * Set the value of categoryName
         *
         * @return  self
         */ 
        public function setCategoryName($categoryName)
        {
                $this->categoryName = $categoryName;

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

    }

?>