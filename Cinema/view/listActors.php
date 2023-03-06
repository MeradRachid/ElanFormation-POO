
<?php ob_start(); ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requete->rowCount() ?> acteurs. </p>

<table class="uk-table uk-table-striped"> 
    <thead>
        <tr>
            <th> PERSONNAGE </th>
            <th> NOM </th>
            <th> PRENOM </th>
            <th> GENRE </th>
        </tr>

    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film)
            { ?>
                <tr>
                    <td> <?= $film["character_name"] ?> </td>
                    <td> <?= $film["lastName"] ?> </td>
                    <td> <?= $film["firstName"] ?> </td>
                    <td> <?= $film["gender"] ?> </td>
                </tr>
      <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des Acteurs"; 
$titre_secondaire = "Liste des acteurs";
    $contenu = ob_get_clean();
    require "view/template.php";        
?>