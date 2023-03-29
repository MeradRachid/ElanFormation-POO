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
        class Reservation // Ensemble d'états (propriétés) et de comportements (méthodes)
        {                // C'est le moule qui sert à créer des objets (= Instanciation d'un classe)
            private string $_libelle;
            private Client $_client;
            private Hotel $_hotel;
            private chambre $_chambre;
            private DateTime $_debutReservation;
            private DateTime $_finReservation;
            private bool $_statutReserve;
            
            // L’encapsulation désigne le principe de regroupement des données et du code qui les utilise au sein d’une même unité
            // private seulement au sein de la class 
            // public dans la classe et en dehors
            // protected dans le cadre de l'héritage
            
            public function __construct($libelle, $client, $hotel, $chambre, $debutReservation, $finReservation)
            {   // Méthode magique définissant les propriétés natives à la création d'un objet
                // L'objet courant sur lequel on travaille est toujours désigné par la variable $this
                $this->_libelle = $libelle;
                $this->_client = $client;
                $client->ajouterReservation($this);
                $this->_hotel = $hotel;
                $hotel->ajouterReservation($this);
                $this->_chambre = $chambre;
                $chambre->ajouterReservation($this);
                $this->_debutReservation = new DateTime($debutReservation);
                $this->_finReservation = new DateTime($finReservation);
                $chambre->set_statutReserve(true);
                $this->_statutReserve = true;
            }
            
            /**
             * Get the value of _libelle
             */ 
            public function get_libelle()
            {
                return $this->_libelle;
            }
            /**
             * Get the value of _client
             */ 
            public function get_client()
            {
                return $this->_client;
            }  
            /**
             * Set the value of _libelle
             *
             * @return  self
             */ 
            public function set_libelle($libelle)
            {
                $this->_libelle = $libelle;
                
                return $this;
            }
            /**
             * Set the value of _client
             *
             * @return  self
             */ 
            public function set_client($client)
            {
                $this->_client = $client;
                
                return $this;
            }
            /**
             * Get the value of _hotel
             */ 
            public function get_hotel()
            {
                return $this->_hotel;
            }
            /**
             * Set the value of _hotel
             *
             * @return  self
             */ 
            public function set_hotel($hotel)
            {
                $this->_hotel = $hotel;
                
                return $this;
            }
            /**
             * Get the value of _chambre
             */ 
            public function get_chambre()
            {
                return $this->_chambre;
            }
            /**
             * Set the value of _chambre
             *
             * @return  self
             */ 
            public function set_chambre($chambre)
            {
                $this->_chambre = $chambre;
                
                return $this;
            }
            /**
             * Get the value of _debutReservation
             */ 
            public function get_debutReservation()
            {
                return $this->_debutReservation->format("d F Y");
            }
            /**
             * Set the value of _debutReservation
             *
             * @return  self
             */ 
            public function set_debutReservation($debutReservation)
            {
                $this->_debutReservation = $debutReservation;
                
                return $this;
            }
            /**
             * Get the value of _finReservation
             */ 
            public function get_finReservation()
            {
                return $this->_finReservation->format("d F Y");
            }
            /**
             * Set the value of _finReservation
             *
             * @return  self
             */ 
            public function set_finReservation($finReservation)
            {
                $this->_finReservation = $finReservation;
                
                return $this;
            }
            /**
             * Get the value of _statutReserve
             */ 
            public function get_statutReserve()
            {
                    return $this->_statutReserve;
            }
            /**
             * Set the value of _statutReserve
             *
             * @return  self
             */ 
            public function set_statutReserve($statutReserve)
            {
                    $this->_statutReserve = $statutReserve;

                    return $this;
            }
            
            public function ajouterReservation(Reservation $reservation) 
            {
                $this->_reservations []= $reservation;
            }
            public function calculerNbreJours()
            {
                $interval = 0;
                $depart = new DateTime($this->get_debutReservation());
                $arrivee = new DateTime($this->get_finReservation());
                $interval = $depart->diff($arrivee);
                $elapsed = $interval->format("%d");
                return $elapsed;
            }
            public function afficherReservation()
            {
                echo '<div class=" "> Reservation '.$this->_libelle;
                if($this->_reservations == null)
                {
                    echo ' Aucune Réservation en cours ';
                }
                else
                {             
                    foreach($this->_reservations as $reservation)
                    {                
                        echo ' Reservation '.$reservation->__toString();
                    }
                }
                echo '</div>';
            }

            public function __toString() 
            {
                return  $this->get_libelle().", ".$this->get_client().'<br>'.
                        "Chambre : ".$this->_chambre->get_intituleChambre().
                        "(".$this->_chambre->get_nombreDeLits()." - Tarif Journéee : ".$this->_chambre->get_prix()." € - Wifi : ".$this->_chambre->get_statutWifi(). ') <br>'.
                        " Du : ".$this->get_debutReservation()." Au : ".$this->get_finReservation().'<br>'.
                        $this->_client->calculerPrixReservation();
            }
        }
    ?>
    </body>
</html>