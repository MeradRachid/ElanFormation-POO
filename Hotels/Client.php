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
                class Client // Ensemble d'états (propriétés) et de comportements (méthodes)
                {           // C'est le moule qui sert à créer des objets (= Instanciation d'un classe)
                        private $_nom;
                        private $_prenom;
                        private $_reservations;

                        // L’encapsulation désigne le principe de regroupement des données et du code qui les utilise au sein d’une même unité
                        // private seulement au sein de la class 
                        // public dans la classe et en dehors
                        // protected dans le cadre de l'héritage

                        public function __construct($nom, $prenom) 
                        {   // Méthode magique définissant les propriétés natives à la création d'un objet
                        // L'objet courant sur lequel on travaille est toujours désigné par la variable $this
                        $this->_nom = $nom;
                        $this->_prenom = $prenom;
                        $this->_reservations = [];
                        }
                        public function __toString() 
                        {
                        return $this->get_nom().", ".$this->get_prenom();
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

                        public function ajouterReservation(Reservation $reservation) 
                        {
                        $this->_reservations []= $reservation;
                        }
                        
                        public function calculerPrixReservation()
                        {
                                $prixReservation = 0;
                                foreach($this->_reservations as $reservation)
                                {       // on part de _reservations , et on va dans la classe chambre et comme on acces à la classe, on aussi acces aux propriétés = chainage 
                                        $nombreDeJours = $reservation->calculerNbreJours();
                                        $prixReservation = $reservation->get_chambre()->get_prix();
                                        $prixTotalReservation = $prixReservation * $nombreDeJours;
                                }

                                return " Montant Total Séjour : ".$prixReservation." € x ".$nombreDeJours." Jours > Total : ".$prixTotalReservation." € <br>";
                        }
                        // public function calculerPrixTotalReservation()
                        // {
                        //         $prixParJour = 0;
                        //         $prixTotalReservation = 0;
                        //         foreach($this->_reservations as $reservation)
                        //         {       
                        //                 $prixParJour += $reservation->get_chambre()->get_prix();
                        //                 $nombreDeJours = $reservation->calculerNbreJours();
                        //                 $prixTotalReservation = $prixParJour * $nombreDeJours; 
                        //         }
                        //         echo "Nombre de jours total de réservations : ".$nombreDeJours." Prix total : ".$prixTotalReservation.' € <br>';
                        //         return $prixTotalReservation;
                        // }
                        public function afficherClient()
                        {
                                echo '<div class="uk-card uk-card-default uk-card-body uk-width-1-2@m"> Réservations de : '.$this->_nom." ".$this->_prenom.'<br>';
                                if($this->_reservations == null)
                                {
                                        echo ' Aucune Réservation en cours';
                                        echo '</div>';
                                }
                                else
                                {
                                        foreach($this->_reservations as $reservation)
                                        {                
                                                echo ' Reservation '.$reservation->__toString().'<br>';
                                        }
                                        echo '</div>';
                                }
                        }
                }
        ?>
        </body>
</html>