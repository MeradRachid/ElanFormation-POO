<?php
    class Client // Ensemble d'états (propriétés) et de comportements (méthodes)
    {           // C'est le moule qui sert à créer des objets (= Instanciation d'un classe)
        private $_nom;
        private $_prenom;
        private $_reservations;

        // L’encapsulation désigne le principe de regroupement des données et du code qui les utilise au sein d’une même unité
        // private seulement au sein de la class 
        // public dans la classe et en dehors
        // protected dans le cadre de l'héritage

        public function __construct($nom, $prenom, $reservations) 
        {   // Méthode magique définissant les propriétés natives à la création d'un objet
            // L'objet courant sur lequel on travaille est toujours désigné par la variable $this
          $this->_nom = $nom;
          $this->_prenom = $prenom;
          $this->_reservations = [];
        
        }

        

    }
?>