<?php
    class Reservation // Ensemble d'états (propriétés) et de comportements (méthodes)
    {                // C'est le moule qui sert à créer des objets (= Instanciation d'un classe)
        private $_nom;
        private $_hotels =[];
        private $_clients =[];
        private $_chambres =[];
        private $_dateReservations =[];

        // L’encapsulation désigne le principe de regroupement des données et du code qui les utilise au sein d’une même unité
        // private seulement au sein de la class 
        // public dans la classe et en dehors
        // protected dans le cadre de l'héritage

        public function __construct($nom, Client $client, Hotel $hotel, Chambre $chambre, $reservation) 
        {   // Méthode magique définissant les propriétés natives à la création d'un objet
            // L'objet courant sur lequel on travaille est toujours désigné par la variable $this
          $this->_nom = $nom;
          $this->_clients []= $client;
          $this->_hotels []= $hotel;
          $this->_chambres []= $chambre;
          $this->_dateReservations []= $reservation;
        
        }

        

    }
?>