<!-- "template.php" qui servira de base / squelette à l'ensemble des vues.

On aura besoin de déclarer le doctype, les links css / js etc qu'une seule fois dans ce fichier. 

On exploitera ce qu'on appelle "la temporisation de sortie" en PHP -->

<?php ob_start(); ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requete->rowCount() ?> films. </p>

<table class="uk-table uk-table-striped"> 
    <thead>
        <tr>
            <th> TITRE </th>
            <th> PARUTION </th>
        </tr>

    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film)
            { ?>
                <tr>
                    <td> <?= $film["movie_title"] ?> </td>
                    <td> <?= $film["release_date"] ?> </td>
                </tr>
      <?php } ?>
    </tbody>
</table>

<?php

    $titre = "Liste des films"; 
    $titre_secondaire = "Liste des films";
    $contenu = ob_get_clean();
    require "view/template.php";

    /**
     * On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
     * On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie)
     * Avec pour but de stocker le contenu dans une variable $contenu
     * 
     * Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
     * 
     * Du coup dans notre "template.php" on aura des variables 
     * Qui vont accueillir les éléments provenant des différentes vues
     * Au final, DANS CHAQUE VUE, il faudra TOUJOURS : 
     * --> Donner une valeur à $titre, $contenu et $titre_secondaire 
     * (Voir images/pj dans le dossier Cinema)
     *  */ 
    
?>