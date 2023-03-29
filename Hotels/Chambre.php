<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/css/uikit.min.css" />
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/js/uikit-icons.min.js"></script>
    <title>PHP Poo 3</title>
</head>
        <body>
        <?php
                class Chambre // Ensemble d'états (propriétés) et de comportements (méthodes)
                {            // C'est le moule qui sert à créer des objets (= Instanciation d'un classe)
                        private $_intituleChambre;
                        private $_prix;
                        private $_hotel;
                        private $_nombreDeLits;
                        private $_statutWifi;
                        private $_statutReserve;
                        private $_reservations;

                        // L’encapsulation désigne le principe de regroupement des données et du code qui les utilise au sein d’une même unité
                        // private seulement au sein de la class 
                        // public dans la classe et en dehors
                        // protected dans le cadre de l'héritage

                        public function __construct($intituleChambre, $prix, $nombreDeLits, Hotel $hotel) 
                        {   // Méthode magique définissant les propriétés natives à la création d'un objet
                        // L'objet courant sur lequel on travaille est toujours désigné par la variable $this
                        $this->_intituleChambre = $intituleChambre;
                        $this->_prix = $prix;
                        $this->_hotel = $hotel;
                        $hotel->ajouterChambre($this);
                        $this->_nombreDeLits = $nombreDeLits;
                        $this->_statutWifi = false;
                        $this->_statutReserve = false;
                        $this->_reservations = [];
                        }
                        
                        /**
                         * Get the value of _intituleChambre
                         */ 
                        public function get_intituleChambre()
                        {
                                return $this->_intituleChambre;
                        }
                        /**
                         * Get the value of _prix
                         */ 
                        public function get_prix()
                        {
                                return $this->_prix;
                        }
                        /**
                         * Get the value of _hotel
                         */ 
                        public function get_hotel()
                        {
                                return $this->_hotel;
                        }
                        /**
                         * Get the value of _nombreDeLits
                         */ 
                        public function get_nombreDeLits()
                        {
                                return $this->_nombreDeLits;
                        }
                        /**
                         * Get the value of _statutWifi
                         */ 
                        public function get_statutWifi()
                        {
                                if($this->_statutWifi == true)
                                {

                                        return "Oui";
                                }
                                else
                                {
                                        return "Non";
                                }
                        }
                        /**
                         * Get the value of _statutReserve
                         */ 
                        public function get_statutReserve()
                        {
                                return $this->_statutReserve;
                        }
                        

                        /**
                         * Set the value of _intituleChambre
                         *
                         * @return  self
                         */ 
                        public function set_intituleChambre($_intituleChambre)
                        {
                                $this->_intituleChambre = $_intituleChambre;
                                
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
                        /**
                         * Set the value of _hotel
                         *
                         * @return  self
                         */ 
                        public function set_hotel($_hotel)
                        {
                                $this->_hotel = $_hotel;
                                
                                return $this;
                        }
                        /**
                         * Set the value of _nombreDeLits
                         *
                         * @return  self
                         */ 
                        public function set_nombreDeLits($_nombreDeLits)
                        {
                                $this->_nombreDeLits = $_nombreDeLits;

                                return $this;
                        }
                        /**
                         * Set the value of _statutWifi
                         *
                         * @return  self
                         */ 
                        public function set_statutWifi($_statutWifi)
                        {
                                $this->_statutWifi = $_statutWifi;
                                
                                return $this;
                        }
                        /**
                         * Set the value of _statutReserve
                         *
                         * @return  self
                         */ 
                        public function set_statutReserve($_statutReserve)
                        {
                                $this->_statutReserve = $_statutReserve;
                                
                                return $this;
                        }
                        
                        public function ajouterChambre(Chambre $chambre) 
                        {
                        $this->_chambres []= $chambre;
                        }
                        public function ajouterReservation(Reservation $reservation) 
                        {
                                $this->_reservations []= $reservation;
                        }
                        public function afficherChambre()
                        {
                                if($this->get_statutReserve() == false)
                                {
                                        echo '<div class="uk-card uk-card-default uk-card-body uk-width-1-2@m"> Chambre : '.$this->_intituleChambre.'
                                        Nombre de Lits : '.$this->get_nombreDeLits().'
                                        <br> Prix par journée : '.$this->get_prix().'
                                        <br> Wifi Disponible : '.$this->get_statutWifi().'
                                        <br> Réservations en Cours
                                        <br> Aucune Réservation en cours';
                                        echo '</div>';
                                }
                                else
                                {
                                        echo '<div class="uk-card uk-card-default uk-card-body uk-width-1-2@m"> Chambre : '.$this->_intituleChambre.'
                                        Nombre de Lits : '.$this->get_nombreDeLits().'
                                        <br> Prix par journée : '.$this->get_prix().'
                                        <br> Wifi Disponible : '.$this->get_statutWifi().'
                                        <br> Réservations en Cours';
                                        foreach($this->_reservations as $reservation)
                                        {
                                                echo ' Reservation '.$reservation->__toString().'<br>';
                                        }
                                        echo '</div>';
                                }
                        }

                        public function __toString()
                        {   // Méthode magique permettant de retourner une valeur en string
                                return $this->get_intituleChambre().'<br>'.$this->get_prix().'<br>'.$this->get_statutWifi().'<br>'.$this->get_statutReserve();
                        }
                }
        ?>
        <body>
</html>
