<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="algo.css">
    <title>PHP Poo 3</title>
</head>
<body>
    <h2>Exercice POO : HOTEL ☆☆☆☆ </h2>
    // A partir de captures d'écran, réaliser une application en POO. <br>
    Elle permettra la gestion de réservations de chambres par des clients dans différents hôtels :
<br><br>
        <?php
            spl_autoload_register(function ($class_name) 
                                {
                                require_once $class_name . '.php';
                                });
            
            $hotel1 = new Hotel("Hotel Hilton ✯✯✯✯ Strasbourg", "10, route de la Gare 67000 STRASBOURG", 30);
            $hotel2 = new Hotel("Hotel Regent ✯✯✯✯ Paris", "61 Rue Dauphine, 75006 PARIS", 25);

            // $hotel1->afficherHotel();
            // $hotel2->afficherHotel();
        ?>
</body>
</html>
 
