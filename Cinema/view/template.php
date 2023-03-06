<!-- "template.php" qui servira de base / squelette à l'ensemble des vues.

On aura besoin de déclarer le doctype, les links css / js etc qu'une seule fois dans ce fichier. 

On exploitera ce qu'on appelle "la temporisation de sortie" en PHP -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $titre ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="public/css/style.css"/> 
    </head>
    <body>
        <?= $contenu ?>
        <!-- /**
         * On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
         * On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie)
         * Avec pour but de stocker le contenu dans une variable $contenu
         * 
         * Le require de fin permet d'injecter le contenu dans le template "squelette" template.php
         * 
         * Du coup dans notre "template.php" on aura des variables 
         * Qui vont accueillir les éléments provenant des différentes vues
         * Au final, DANS CHAQUE VUE, il faudra TOUJOURS : 
         * Donner une valeur à $titre, $contenu et $titre_secondaire
         *  */  -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    </body>
</html>