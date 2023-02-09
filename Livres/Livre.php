<?php


    class Livre 
    {
        private string $_titre;
        private int $_nombrePages;
        private int $_anneeParution;
        private float $_prix;
        private Auteur $_auteur;
          
        public function __construct($titre, $nombrePages, $anneeParution, $prix, $auteur)
        {
            $this->_titre = $titre;
            $this->_nombrePages = $nombrePages;
            $this->_anneeParution = $anneeParution;
            $this->_prix = $prix;
            $this->_auteur = $auteur;
            $auteur->ajouterLivre($this);
        }
          
        public function __toString() 
        {
            return $this->get_titre()." : ".$this->get_nombrePages()." Pages, Paru en (".$this->get_anneeParution()."), Prix : ".$this->get_prix()." €";
        }
          
          /**
           * Get the value of _titre
           */ 
        public function get_titre()
        {
            return $this->_titre;
        }
          /**
           * Get the value of _nombrePages
           */ 
        public function get_nombrePages()
        {
                    return $this->_nombrePages;
        }
          /**
           * Get the value of _anneeParution
           */ 
        public function get_anneeParution()
        {
                    return $this->_anneeParution;
        }  
          /**
           * Get the value of _prix
           */ 
        public function get_prix()
        {
            return $this->_prix;
        }
          
          /**
           * Set the value of _titre
           *
           * @return  self
           */ 
        public function set_titre($_titre)
        {
            $this->_titre = $_titre;
            
            return $this;
        }
          /**
           * Set the value of _nombrePages
           *
           * @return  self
           */ 
        public function set_nombrePages($_nombrePages)
        {
            $this->_nombrePages = $_nombrePages;
            
            return $this;
        }
          /**
           * Set the value of _anneeParution
           *
           * @return  self
           */ 
        public function set_anneeParution($_anneeParution)
        {
                    $this->_anneeParution = $_anneeParution;

                    return $this;
        }
          /**
           * Set the value of _prix
           *
           * @return  self
           */ 
        public function set_prix($_prix)
        {
                    $this->_prix = $_prix;

                    return $this;
        }
    }                   
?>