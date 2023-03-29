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

            public function __construct($nomHotel, $adresseHotel)
            {   // Méthode magique définissant les propriétés natives à la création d'un objet
                // L'objet courant sur lequel on travaille est toujours désigné par la variable $this
                $this->_nomHotel = $nomHotel;
                $this->_adresseHotel = $adresseHotel;
                $this->_chambres = [];
                $this->_reservations = [];
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

            public function get_reservation()
            {
                echo '<div class="uk-card uk-card-default uk-card-body uk-width-1-2@m"><h2 class="uk-card-title"> Réservations '.$this->_nomHotel.'</h2>';

                if($this->_reservations == [])
                {
                    echo '<span class="uk-label uk-label-success"> Aucune Réservation en cours ! </span>';
                }
                else
                {
                    echo '<span class="uk-label uk-label-success">'.count($this->_reservations).' Réservations en Cours :</span> <br>';
                    foreach($this->_reservations as $reservation)
                    {
                        echo ' Reservation '.$reservation->__toString().' <br>';
                    }
                }
                echo '</div>';
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
                echo   '<div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
                        <h3 class="uk-card-title">'.$this->_nomHotel.'</h3>
                        <p class ="infoHotel uk-card">
                        Adresse : '.$this->_adresseHotel.'<br>'.
                        "Nombre de Chambres Total : ".count($this->_chambres).' <br>'.
                        "Nombre de Chambres Réservés : ".count($this->_reservations).'<br>'.
                        "Nombre de Chambres Disponible : ".$this->calculerChambresDispo().
                        '</p> </div>';
            }

            public function __toString()
            {   // Méthode magique permettant de retourner une valeur en string
                return $this->get_nomHotel().' <br> '.$this->get_adresseHotel();
            }
        }
    ?>
    </body>
</html>