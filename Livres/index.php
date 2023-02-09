<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="algo.css">
      <title>PHP Poo 1</title>
  </head>
  <body> 

    <h2>Exercice POO : Livres</h2>
      // Vous êtes chargé(e) de créer un projet orienté objet permettant de gérer des livres et leurs auteurs respectifs. <br> 
      // Les livres sont caractérisés par un titre, un nombre de pages, une année de parution, un prix et un auteur. <br>
      // Un auteur comporte un nom et un prénom.
<br><br>

      <?php

      spl_autoload_register(function ($class_name) 
                            {
                              require_once $class_name . '.php';
                            });

      $auteur1 = new Auteur("KING", "Stephen");
        
      $livre1 = new Livre("« Ça »", 1138, 1986, 20.00, $auteur1);
      $livre2 = new Livre("« Simetierre »", 374, 1983, 15.00, $auteur1);
      $livre3 = new Livre("« Le Fléau »", 823, 1978, 14.00, $auteur1);
      $livre4 = new Livre("« Shining »", 447, 1977, 16.00, $auteur1);

      $auteur1->afficherBibliographie(); 
    ?>
  </body>
</html>
