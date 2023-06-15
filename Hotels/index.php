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
        <div class="header uk-card uk-card-body ">
            <h1 class="uk-card-title uk-text-bolder">Exercice POO : HOTEL ☆☆☆☆</h1>
            <p class="consigne uk-text-bold"> À partir de captures d'écran, vous réaliserez une application en POO. <br>
            Elle permettra la gestion de réservations de chambres par des clients dans différents hôtels :
            </p>
        </div>
        <?php
            spl_autoload_register(function ($class_name) 
                                {
                                require_once $class_name . '.php';
                                });
            
            $hotel1 = new Hotel("Hotel Hilton ✯✯✯✯ Strasbourg", "10, route de la Gare 67000 STRASBOURG");
            $hotel2 = new Hotel("Hotel Regent ✯✯✯✯ Paris", "61 Rue Dauphine, 75006 PARIS");
            
            $chambre1A= new Chambre('"Accacia - RDC Gauche"', 300, "4 lits", $hotel1);
            $chambre1B= new Chambre('"Laurier - RDC Droite"', 120, "2 lits", $hotel1);
            $chambre1C= new Chambre('"Jasmin - 1° Gauche"', 120, "2 lits", $hotel1);
            $chambre1D= new Chambre('"Sauge - 1° Droite"', 120, "2 lits", $hotel1);
            $chambre2A= new Chambre('"Romarin - 2° Gauche"', 300, "4 lits", $hotel2);
            $chambre2B= new Chambre('"Coriandre - 2° Droite"', 300, "4 lits", $hotel2);
            $chambre2C= new Chambre('"Bergamote - 3° Droite"', 300, "4 lits", $hotel2);
            $chambre2D= new Chambre('"Marjolaine - 3° Gauche"', 300, "4 lits", $hotel2);

            $client1 = new Client("Mickael", "MURMANN");
            $client2 = new Client("Virgile", "GIBELLO");
            $client3 = new Client("Rachid", "MERAD");

            $reservation1 = new Reservation("N°784562", $client2, $hotel1, $chambre1A, "01/01/2023", "01/15/2023");
            $chambre1A->set_statutWifi(true);
            $reservation2 = new Reservation("N°687463", $client1, $hotel1, $chambre1B, "01/01/2023", "01/15/2023");
            $reservation3 = new Reservation("N°365458", $client1, $hotel1, $chambre1C, "01/01/2023", "01/15/2023"); 
            
            $hotel1->afficherHotel();
            $hotel1->get_reservation();

            $hotel2->get_reservation();
            
            $client1->afficherClient();

        ?>
    </body>
</html>