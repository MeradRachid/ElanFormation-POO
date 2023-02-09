<?php

    class Auteur 
    {
        private $_nom;
        private $_prenom;
        private $_bibliographie = [];

        public function __construct($nom, $prenom) 
        {
            $this->_nom = $nom;
            $this->_prenom = $prenom;
        }
           
          /**
           * Get the value of _nom
           */ 
        public function get_nom()
        {
                    return $this->_nom;
        }
          /**
           * Get the value of _prenom
           */ 
        public function get_prenom()
        {
                    return $this->_prenom;
        }

          /**
           * Set the value of _nom
           *
           * @return  self
           */ 
        public function set_nom($_nom)
        {
                    $this->_nom = $_nom;

                    return $this;
        }
          /**
           * Set the value of _prenom
           *
           * @return  self
           */ 
        public function set_prenom($_prenom)
        {
                    $this->_prenom = $_prenom;

                    return $this;
        }

        public function ajouterLivre(Livre $livre) 
        {
            $this->_bibliographie[] = $livre;
        }
          
        public function afficherBibliographie() 
        {
            echo '<table border=1><th class="h2"> info Auteur : '.$this->get_prenom().", ".$this->get_nom().'</th>';
            echo '</tr></td><th class="h2"> Bibliographie : </th></td></tr>';
            foreach ($this->_bibliographie as $livre) 
            {
              echo '<tr><td>'.$livre->__toString().'</td></tr>';
            }
            echo '</table>';
        }
        public function __toString()
        {
          return $this->get_prenom().$this->get_nom();
        }
    }
?>