<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="algo.css">
      <title>PHP Poo 2</title>
  </head>
  <body> 

    <h2>Exercice POO : Banques</h2>
    // Vous êtes chargé(e) de créer un projet orienté objet permettant de gérer des titulaires et leurs comptes bancaires respectifs. 
<br><br>
      <?php

        spl_autoload_register(function ($class_name) 
                            {
                              require_once $class_name . '.php';
                            });

        $titulaire1 = new Titulaire("Stanley", "IPKISS", "30/10/1985", "Edge City");
        $titulaire2 = new Titulaire("Loki", "ASURA", "03/01/1958", "Asgard City");
                    
        $compteBancaire1 = new CompteBancaire("CAV N° X3942 5165 4165 6465 29", "£ (Livre Sterling) ", $titulaire1);
        $compteBancaire2 = new CompteBancaire("LDD N° X3924 5156 4156 6456 92", "₭ (Couronne Nordique) ", $titulaire2);
        $compteBancaire3 = new CompteBancaire("CEP N° X4293 6551 6514 6546 29", "¤ (Compte Universel) ", $titulaire2);
                    
        $titulaire1->ajouterCompteBancaire($compteBancaire1);
        $titulaire2->ajouterCompteBancaire($compteBancaire2);
        $titulaire2->ajouterCompteBancaire($compteBancaire3);
       
        $compteBancaire3->set_soldeActuel("∝ ");

        $titulaire1->afficherTitulaire();
                    
        $compteBancaire2->crediterCompteBancaire(59696600);
        $compteBancaire2->afficherCompteBancaire();
                            
        $compteBancaire1->virementCompteBancaire($compteBancaire2, 5966600);
                    
        $compteBancaire1->afficherCompteBancaire();
        $titulaire2->afficherTitulaire();
        
        $compteBancaire1->debiterCompteBancaire(5999900);              

      ?>
  </body>
</html>