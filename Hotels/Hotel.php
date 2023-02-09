<?php
    class Hotel // Ensemble d'états (propriétés) et de comportements (méthodes)
    {          // C'est le moule qui sert à créer des objets (= Instanciation d'un classe)
        private $_nomHotel;
        private $_adresseHotel;
        private $_chambres;
        private $_reservations;
        
        // L’encapsulation désigne le principe de regroupement des données et du code qui les utilise au sein d’une même unité
        // private seulement au sein de la class 
        // public dans la classe et en dehors
        // protected dans le cadre de l'héritage

        public function __construct($nomHotel, $adresseHotel, $nombreChambresTotal)
        {   // Méthode magique définissant les propriétés natives à la création d'un objet
            // L'objet courant sur lequel on travaille est toujours désigné par la variable $this
            $this->_nomHotel = $nomHotel;
            $this->_adresseHotel = $adresseHotel;
            $this->_chambres = [];
            $this->_reservations = [];
        }
        public function __toString()
        {   // Méthode magique permettant de retourner une valeur en string
            return $this->get_nomHotel()."<br>".$this->get_adresseHotel();
        }
        
        // Récupère la valeur en question
        public function get_nomHotel()
        {
            return $this->_nomHotel;
        }
        public function get_adresseHotel()
        {
            return $this->_adresseHotel;
        }

        // Réaffecte la valeur en question
        public function set_nomHotel($nomHotel)
        {
            $this->_nomHotel = $nomHotel;
        }
        public function set_adresseHotel($adresseHotel)
        {
            $this->_adresseHotel = $adresseHotel;
        }

        public function ajouterChambre(Chambre $chambre) 
        {
            $this->_chambres []= $chambre;
        }
        public function ajouterReservation(Reservation $reservation) 
        {
            $this->_reservations []= $reservation;
        }
        public function calculerChambresDispo()
        {
            $nombreChambresDispo = count($this->_chambres) - count($this->_reservations);
            return $nombreChambresDispo;
        }
        
        public function afficherHotel()
        {
            echo '<table border=1> <th class="h2"> info '.$this->_nomHotel.'</th>
                  <tr><td> Adresse : '.$this->_adresseHotel."<br>".
                  "Nombre de Chambres Total : ".count($this->_chambres)."<br>".
                  "Nombre de Chambres Réservés : ".count($this->_reservations)."<br>".
                  "Nombre de Chambres Disponible : ".$this->calculerChambresDispo().'</td></tr>';
            echo '</table> <br>';
        }

    }
?>